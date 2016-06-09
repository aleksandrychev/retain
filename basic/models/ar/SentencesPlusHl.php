<?php
/**
 * Created by PhpStorm.
 * User: ialeksandrychev
 * Date: 28.04.16
 * Time: 14:59
 */

namespace app\models\ar;

class SentencesPlusHl extends \app\models\ar\base\SentencesPlusHl
{

    public function rules()
    {
        $rules = parent::rules();
        array_push($rules,
            [['projectName', 'docName'], 'safe']
        );
        return $rules;

    }

    public function getProjectName()
    {
        return $this->project->title;
    }


    public function getReference()
    {
        $ref = '';

        if ($this->page_number) {
            $ref .= 'Page: ' . $this->page_number . ' ';
        }
        if ($this->paragraph_number) {
            $ref .= 'Para.: ' . $this->paragraph_number . ' ';
        }
        if ($this->line_number) {
            $ref .= 'Line: ' . $this->line_number . ' ';
        }

        return $ref;
    }


    public function getDocName()
    {
        return $this->doc->title;
    }

    public function getKeywordString()
    {
        $ks = '';
        if ($this->keywords) {

            foreach ($this->keywords as $k) {
                $ks .= $k->text . ', ';
            }
            $ks = substr($ks, 0, -2);
        }
        return $ks;
    }

    public function getConceptString()
    {
        $ks = '';
        if ($this->concepts) {

            foreach ($this->concepts as $k) {
                $ks .= $k->text . ', ';
            }
            $ks = substr($ks, 0, -2);
        }
        return $ks;
    }

    public function getTaxonomyString()
    {
        $ks = '';
        if ($this->taxonomy) {

            foreach ($this->taxonomy as $k) {
                $ks .= $k->text . ', ';
            }
            $ks = substr($ks, 0, -2);
        }
        return $ks;
    }

    public function getProject()
    {
        return $this->hasOne(Projects::className(),
            ['id' => 'project_id'])->viaTable('documents', ['id' => 'doc_id']);
    }

    public function getKeywords()
    {
        return $this->hasMany(\app\models\ar\ExtractedKeywords::className(),
            ['doc_id' => 'doc_id']);
    }

    public function getConcepts()
    {
        return $this->hasMany(\app\models\ar\ExtractedConcepts::className(),
            ['doc_id' => 'doc_id']);
    }


    public function getTaxonomy()
    {
        return $this->hasMany(\app\models\ar\ExtractedTaxonomy::className(),
            ['doc_id' => 'doc_id']);
    }

}