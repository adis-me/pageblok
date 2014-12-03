<?php


namespace Pageblok\Blocks\Controllers;


use Pageblok\Blocks\Interfaces\BlockRepositoryInterface;
use Pageblok\Core\Controllers\BaseController;

class BlockController extends BaseController
{
    protected $package = 'pageblok::';
    
    /**
     * @var Array with groupnames used by user for his blocks.
     */
    protected $groups;

    public function __construct(BlockRepositoryInterface $blockRepository)
    {
        $this->repository = $blockRepository;
        $this->groups = $blockRepository->getGroups();

        parent::__construct();
    }

    /**
     * @inheritdoc
     */
    public function index()
    {
        $group = \Input::get('group');
        if ($group) {
            $this->data['blocks'] = $this->repository->getByGroup($group);

        } else {
            $group = \Lang::get("pageblok::blocks.please.select");
        }

        $this->data['groups'] = $this->groups;
        $this->data['selectedGroup'] = ucfirst($group);

        return parent::index();
    }

    /**
     * @inheritdoc
     */
    public function create()
    {
        $this->data = [
            'templates' => \Pageblok::getTemplates("$this->modelName"),
            'contentTypes' => \Pageblok::getContentTypes(),
            'defaultTemplate' => \Block::getDefaultTemplate(),
        ];

        return parent::create();
    }

    /**
     * @inheritdoc
     */
    public function save()
    {
        $this->data = [
            'pb_name' => \Input::get('pb_name'),
            'title' => \Input::get('title'),
            'subtitle' => \Input::get('subtitle'),
            'description' => \Input::get('description'),
            'css_classes' => \Input::get('css_classes'),
            'image_ref' => \Pageblok::uploadFile(\Input::file('image_ref')),
            'hyperlink' => \Input::get('hyperlink'),
            'template' => \Input::get('template'),
            'content_type' => \Input::get('content_type'),
            'content' => \Input::get('content'),
            'published' => \Input::get('published'),
            'group' => \Input::get('group'),
            'created_by' => \Auth::user()->id,
        ];

        if (\Input::file('image_ref')) {
            $this->data['image_ref'] = \Pageblok::uploadFile(\Input::file('image_ref'));
        }

        return parent::save();
    }

    /**
     * @inheritdoc
     */
    public function edit($id)
    {
        $this->data = [
            'templates' => \Pageblok::getTemplates("block"),
            'contentTypes' => \Pageblok::getContentTypes(),
            'defaultTemplate' => \Block::getDefaultTemplate(),
        ];

        return parent::edit($id);
    }


    /**
     * @inheritdoc
     */
    public function update($id)
    {
        $this->data = [
            'pb_name' => \Input::get('pb_name'),
            'title' => \Input::get('title'),
            'subtitle' => \Input::get('subtitle'),
            'description' => \Input::get('description'),
            'template' => \Input::get('template'),
            'content_type' => \Input::get('content_type'),
            'content' => \Input::get('content'),
            'hyperlink' => \Input::get('hyperlink'),
            'css_classes' => \Input::get('css_classes'),
            'published' => \Input::get('published'),
            'group' => \Input::get('group'),
        ];

        if (\Input::get('remove_image')) {
            $this->data['image_ref'] = null;
        } elseif (\Input::file('image_ref')) {
            $this->data['image_ref'] = \Pageblok::uploadFile(\Input::file('image_ref'));
        }

        return parent::update($id);
    }
} 