<?php
/**
 * Blog
 * 
 * A blog module.
 * 
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *  
 * @author Juan Pedro Gonzalez Gutierrez
 * @copyright Copyright (c) 2013 Juan Pedro Gonzalez Gutierrez (http://www.jpg-consulting.com)
 * @license http://www.gnu.org/licenses/gpl-2.0.html GPLv2 License
 */
namespace Blog\Service;

class LanguageService extends AbstractEntityService
{

	protected $default;
	
	protected $current;
	
	/**
	 * Check if a language exists. 
	 * 
	 * @param string $iso The ISO-639-1 language code
	 * @return bool
	 */
	public function has( $iso )
	{
		$language = $this->repository->findOneBy(array('iso' => $iso));
		if (!empty($language)) return true;
		return false;
	}
	
	/**
	 * Get a language
	 * 
	 * @param string $iso
	 */
	public function get( $iso )
	{
		return $this->repository->findOneBy(array('iso' => $iso));
	}
	
	/**
	 * Check if a language is active
	 * 
	 * @param string $iso
	 * @return bool
	 */
	public function isActive( $iso )
	{
		$language = $this->repository->findOneBy(array('iso' => $iso));
		// If it doesn't exist it can not be active ;)
		if (empty($language)) return false;
		
		$active = $language->isActive();
		if (!$active) {
			// The default language is ALWAYS active
			$default = $this->getDefault();
			if ($default->getId() === $language->getId()) {
				$active = true;
			}
		}
		return $active;
	}
	
	/**
	 * Get the default language
	 * 
	 * @throws Exception\DefaultLocaleNotSetException
	 */
	public function getDefault()
	{
		if (empty($this->default)) {
			$options = $this->serviceManager->get('Blog\Service\OptionService');
			$locale = $options->get('default_locale_code');
			if (!empty($locale)) {
				$locale = $this->repository->findOneBy(array('iso' => $locale));
				if (!empty($locale)) {
					$this->default = $locale;
				}
			} else {
				throw new Exception\DefaultLocaleNotSetException();
			}
		}
		
		return $this->default;
	}
	
	/**
	 * Get the current language
	 * 
	 */
	public function getCurrent()
	{
		if (empty($this->current)) {
			if ($this->serviceManager->has('translator')) {
				$translator = $this->serviceManager->get('translator');
				$locale = $translator->getLocale();
				// Normalize...
				$locale = preg_replace('/_/', '-', $locale);
				// ...and get the language part
				$locale = explode('-', $locale, 2);
				
				// if it is active... SET IT!
				$locale = $this->repository->findOneBy(array('iso' => $locale));
				if (!empty($locale)) {
					if ($locale->isActive()) {
						$this->current = $locale;
					}
				}
			}
			
			if (empty($this->current)) {
				if (extension_loaded('intl')) {
					$locale = \Locale::getDefault();
					$locale = \Locale::getPrimaryLanguage($locale);
					
					// if it is active... SET IT!
					$locale = $this->repository->findOneBy(array('iso' => $locale));
					if (!empty($locale)) {
						if ($locale->isActive()) {
							$this->current = $locale;
						}
					}
				}
				
				if (empty($this->current)) {
					$this->current = $this->getDefault();
				}
			}
		}
		
		return $this->current;
	}
}