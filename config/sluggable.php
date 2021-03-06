<?php

return [

    /**
     * Sluggable handlers.
     */
    'handlers' => [
        App\Http\SluggableHandlers\Page\ServiceCategoryHandler::class,
        App\Http\SluggableHandlers\Page\PageSubPageHandler::class,
        App\Http\SluggableHandlers\Page\PageProjectHandler::class,
        App\Http\SluggableHandlers\Page\PageArticleHandler::class,
        App\Http\SluggableHandlers\Page\PageHandler::class,
    ]
];
