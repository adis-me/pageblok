<?php


namespace Pageblok\Blocks\Databases;


use Pageblok\Blocks\Models\Block;
use Pageblok\Blocks\Repositories\BlockRepository;

class BlockSeeder extends \Seeder
{

    public function run()
    {
        $contentBlockData = array(
            'system_name' => 'sample-content-system-name',
            'description' => 'A Sample content description',
            'template' => 'testcontent',
            'content_type' => 'text',
            'content' => 'Sample content',
            'published' => true,
            'created_by' => 1,
            'group' => 'homepage',
        );

        $contentBlockModel = new Block();
        $contentBlockModel->fill($contentBlockData);
        $contentBlockRepo = new BlockRepository($contentBlockModel);
        $contentBlockRepo->create();
    }


} 