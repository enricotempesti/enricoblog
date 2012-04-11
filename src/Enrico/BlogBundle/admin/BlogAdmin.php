<?php
namespace Enrico\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Knp\Menu\ItemInterface as MenuItemInterface;

use Enrico\BlogBundle\Entity\Comment;

class BlogAdmin extends Admin
{
	/**
     * @param \Sonata\AdminBundle\Show\ShowMapper $showMapper
     *
     * @return void
     */
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('title')
            ->add('author')
            ->add('blog')
            ->add('image')
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            
            ->add('title')
            ->add('author')
            ->add('blog')
            ->add('file', 'file', array('required' => false))
            ->add('tags')             
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     *
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('author')
            ->add('blog')
            ->add('image', 'string', array('template' => 
            'SonataMediaBundle:MediaAdmin:list_image.html.twig'))           
            ->add('tags')
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     *
     * @return void
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('author')
            ->add('blog')
            ->add('image')
        ;
    }
    
  public function prePersist($image) {
    $this->saveFile($image);
  }

  public function preUpdate($image) {
    $this->saveFile($image);
  }
 
  public function saveFile($image) {
    $basepath = $this->getRequest()->getBasePath();
    $image->upload($basepath);    
  }
}