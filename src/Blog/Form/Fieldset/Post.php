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

class Post extends Fieldset implements InputFilterProviderInterface
{

    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('post');

        $this->setHydrator(new DoctrineHydrator($objectManager , 'Blog\Entity\Post'));

        $this->add(array(
            'name'       => 'title',
            'options'    => array(
                'label' => 'Title',
            ),
            'attributes' => array(
                'required' => 'required',
            ),
        ));

       // $this->add(array(
       //     'type'    => 'DoctrineModule\Form\Element\ObjectMultiCheckbox',
       //     'name'    => 'categories',
       //     'options' => array(
       //         'object_manager' => $objectManager,
       //         'target_class'   => 'SxBlog\Entity\Category',
       //         'property'       => 'name',
       //     ),
       // ));

        $this->add(array(
            'name'       => 'slug',
            'options'    => array(
                'label' => 'Slug',
            ),
            'attributes' => array(
                'required' => 'required',
            ),
        ));

        $this->add(array(
            'name'       => 'excerpt',
            'type'       => 'Zend\Form\Element\Textarea',
            'options'    => array(
                'label' => 'Excerpt',
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
                'required' => true,
            ),
            'content'  => array(
                'required' => true,
            ),
        );
    }

}