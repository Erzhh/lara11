<?php

namespace App\Domain\Patterns\Bridge\Actions;

use App\Domain\Patterns\Bridge\Abstracts\CategoryPostAbstract;
use App\Domain\Patterns\Bridge\Abstracts\ProductPostAbstract;
use App\Domain\Patterns\Bridge\Models\Category;
use App\Domain\Patterns\Bridge\Models\Product;
use App\Domain\Patterns\Bridge\Realizations\PostBigWalletRealization;

class BridgeAction
{

    public function run(): void
    {
        $posts = [
            new ProductPostAbstract( new Product() ),
            new CategoryPostAbstract( new Category() )
        ];

        foreach ($posts as $post){
            app(PostBigWalletRealization::class)->run($post);
        }

    }

}
