<?php

namespace App;

/**
 * @author Georgian Tomescu
 */
class LanguageSelector 
{
    /**
     * @var array
     */
    protected $languages = [];
    
    /**
     * LanguageSelector constructor.
     */
    public function __construct() 
    {
        $active = \Localization::getRoutePrefix() ?: config('localization.default_locale');
        
        foreach (config('localization.locales') as $locale => $lang) {
            $this->languages[$locale] = [
                'name' => $lang['short'],
                'active' => $locale == $active,
                'url' => url($locale)
            ];
        }
    }
    
    /**
     * @param $model
     */
    public function setLanguages($model) 
    {
        if (!\method_exists($model, 'translations')) {
            return;
        }
        
        $translations = $model->translations()->get();
        
        foreach ($translations as $translation) {
            
            if (!\array_key_exists($translation->locale, $this->languages)) {
                continue;
            }
            
            if (empty($translation->slug)) {
                continue;
            }
            
            $this->languages[$translation->locale]['url'] = '/' . $translation->locale . '/' . str_slug($translation->slug, '-');
        }
    }
    
    /**
     * @param $model
     */
    public function setArticleLanguages(Article $model)
    {
        $translations = $model->translations()->get();
        
        foreach ($translations as $translation) {
            
            if (!\array_key_exists($translation->locale, $this->languages)) {
                continue;
            }
            
            if (empty($translation->slug)) {
                continue;
            }
            
            $this->languages[$translation->locale]['url'] = '/' . $translation->locale . '/' . str_slug($translation->slug, '-');
            
            if ($page = page('ArticlesController')->translation($translation->locale)->first()) {
                $this->languages[$translation->locale]['url'] = '/' . $translation->locale . '/' . str_slug($page->slug, '-') . '/' . str_slug($translation->slug, '-');
            }
        }
    }
    
    /**
     * @return array
     */
    public function getLanguages() 
    {
        return $this->languages;
    }
}