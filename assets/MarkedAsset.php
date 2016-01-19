<?php

namespace uran1980\yii\widgets\markdown\assets;

use yii\web\AssetBundle;

class MarkedAsset extends AssetBundle
{
    public $sourcePath = '@bower/marked/lib';
    public $js = [
        'marked.js',
    ];
}