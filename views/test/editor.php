<?php
use uran1980\yii\widgets\markdown\MarkdownEditor;

echo MarkdownEditor::widget([
    'name'          => 'md-editor',
    'value'         => '# test message',
    'clientOptions' => ['language' => Yii::$app->language],
    'options'       => ['data-provider' => 'markdown'],
]);