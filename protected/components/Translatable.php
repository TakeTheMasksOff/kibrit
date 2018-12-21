<?php
class Translatable extends CActiveRecord
{
        public $translationClass;
        public $translationProperty='translations';
        public $contentTranslationClass;
        public $contentTranslationProperty='translations';
        public function getTranslation($lang) {
            if (isset($this->{$this->translationProperty}[$lang])){
                return $this->{$this->translationProperty}[$lang];
            }
            else return new $this->translationClass();
        }
        public function getLink($lang){
            if (isset($this->{$this->translationProperty}[$lang]) && $this->{$this->translationProperty}[$lang]->link){
                return $this->{$this->translationProperty}[$lang]->link;
            }
            else return Yii::app()->controller->createUrl('site/goto',array('id'=>$this->id,'language'=>$lang));
        }
}