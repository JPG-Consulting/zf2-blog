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
namespace Blog\Form\Fieldset;

use Zend\Form\Fieldset;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\ServiceManager\ServiceManager;

class Post extends Fieldset //implements InputFilterProviderInterface
{

    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('post');

        $this->setHydrator(new DoctrineHydrator($objectManager , 'Blog\Entity\Post'));
        
        $this->add(array(
            'name' => 'language',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => "Language",
                'object_manager' => $objectManager,
                'target_class' => 'Blog\Entity\Language',
                'property' => 'english_name',
        		'find_method'    => array(
                    'name'   => 'findBy',
                    'params' => array(
                        'criteria' => array('active' => 1),
                        'orderBy'  => array('english_name' => 'ASC'),
                    ),
            	),
            ),
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'status',
            'options' => array(
                'label' => 'Status',
                'value_options' => array(
                    'draft'   => 'Draft',
                    'publish' => 'Publish',
                ),
            ),
            'attributes' => array(
                'value' => 'draft'
            )
        ));
        
        $this->add(array(
            'name'       => 'title',
        	'type'       => 'Text',
            'options'    => array(
                'label' => 'Title',
            ),
            'attributes' => array(
                'required' => 'required',
            	'id'       => 'post-editor-title'
            ),
        ));

        $this->add(array(
            'name'       => 'slug',
        	'type'		 => 'text',
            'options'    => array(
                'label' => 'Slug',
            ),
            'attributes' => array(
            	'id'       => 'post-editor-slug'
            ),
        ));

        $this->add(array(
            'name'       => 'excerpt',
            'type'       => 'Zend\Form\Element\Textarea',
            'options'    => array(
                'label' => 'Excerpt',
            ),
            'attributes' => array(
            	'id'       => 'post-editor-excerpt'
            ),
        ));

        $this->add(array(
            'name'       => 'content',
            'type'       => 'Zend\Form\Element\Textarea',
            'options'    => array(
                'label' => 'Content',
            ),
            'attributes' => array(
                'required' => 'required',
            	'id'       => 'post-editor-content'
            ),
        ));
    }

    /**
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return array(
            'title' => array(
                'required' => true,
            ),
            'slug'  => array(
                //'required' => true,
                'filters' => array(
	                array('name' => 'StripTags'),
	                array('name' => 'StringTrim'),
	            ),
	            'validators' => array(
	                array(
	                    'name' => 'StringLength',
	                    'options' => array(
	                        'encoding' => 'UTF-8',
	                        'min' => 0,
	                        'max' => 255,
	                    ),
	                ),
	            ),
            ),
            'content'  => array(
                'required' => true,
            ),
        );
    }
}