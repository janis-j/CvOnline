<?php

namespace app\widgets;

use Yii;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\i18n\Formatter;

class CvView extends Widget
{
    public $model;
    public $attributes;
    public $formatter;
    public $options = ['class' => 'resume-wrapper mx-auto theme-bg-light p-5 mb-5 my-5 shadow-lg'];
    public $rows = [];

    public function init()
    {
        parent::init();

        if ($this->model === null) {
            throw new InvalidConfigException('Please specify the "models" property.');
        }
        if ($this->formatter === null) {
            $this->formatter = Yii::$app->getFormatter();
        } elseif (is_array($this->formatter)) {
            $this->formatter = Yii::createObject($this->formatter);
        }
        if (!$this->formatter instanceof Formatter) {
            throw new InvalidConfigException('The "formatter" property must be either a Format object or a configuration array.');
        }
        $this->normalizeAttributes();
    }

    public function run()
    {
        $this->header();
        $this->intro();
        $this->body();
        $this->footer();
        $tag = ArrayHelper::remove($this->options, 'tag', 'div');
        echo Html::tag($tag, implode("\n", $this->rows), $this->options);
    }

    private function normalizeAttributes()
    {
        foreach ($this->attributes as $name => $group) {
            switch ($name) {
                case 'general-info':
                case 'contacts':
                case 'personal-statement':
                case 'social':
                    $this->byGroup($name, $group, [$this->model]);
                    break;
                case 'education':
                    $this->byGroup($name, $group, $this->model->getEducations());
                    break;
                case 'work-experience':
                    $this->byGroup($name, $group, $this->model->getWorkExperiences());
                    break;
            }
        }
    }

    private function byGroup($name, $group, $models)
    {
        foreach ($models as $key => $model) {
            foreach ($group[0] as $attributeName => $value) {
                $value = ArrayHelper::getValue($model, $attributeName);
                $this->attributes[$name][$key][$attributeName] = $value;
            }
        }
    }

    private function header()
    {
        $general = $this->attributes['general-info'][0];
        $contacts = $this->attributes['contacts'][0];
        ob_start(); ?>
        <div class="resume-header">
            <div class="row align-items-center">
                <div class="resume-title col-12 col-md-6 col-lg-8 col-xl-9">
                    <h2 class="resume-name mb-0 text-uppercase"><?= $general['name'] ?> <?= $general['surname'] ?></h2>
                    <div class="resume-tagline mb-3 mb-md-0"></div>
                </div>
                <div class="resume-contact col-12 col-md-6 col-lg-4 col-xl-3">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><i class="fas fa-phone-square fa-fw fa-lg me-2 "></i><a
                                    class="resume-link" href="tel:#"><?= $contacts['phone'] ?></a></li>
                        <li class="mb-2"><i class="fas fa-envelope-square fa-fw fa-lg me-2"></i><a
                                    class="resume-link" href="mailto:<?= $contacts['email'] ?>"><?= $contacts['email'] ?></a></li>
                        <?php if ($contacts['website']): ?>
                            <li class="mb-2"><i class="fas fa-globe fa-fw fa-lg me-2"></i><a
                                        class="resume-link" target="_blank" href="<?= $contacts['website'] ?>"><?= $contacts['website'] ?></a></li>
                        <?php endif; ?>
                        <li class="mb-0"><i class="fas fa-map-marker-alt fa-fw fa-lg me-2"></i>
                            <?= $contacts['address'] . ', ' . Yii::$app->params['country'][$contacts['country']] ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
        $this->rows[] = ob_get_clean();
    }

    private function intro()
    {
        $general = $this->attributes['general-info'][0];
        ob_start();
        ?>
        <hr>
        <div class="resume-intro py-3">
            <div class="row align-items-center">
                <div class="col-12 col-md-3 col-xl-2 text-center">
                    <img class="resume-profile-image mb-3 mb-md-0 me-md-5  ms-md-0 rounded mx-auto" style="width:50%"
                         src="https://cdn.icon-icons.com/icons2/1378/PNG/512/avatardefault_92824.png" alt="image">
                </div>

                <div class="col text-start">
                    <p class="mb-0"><?= $general['about'] ?></p>
                </div>
                <!--//col-->
            </div>
        </div>
        <?php
        $this->rows[] = ob_get_clean();
    }

    private function body()
    {
        $workExperiences = $this->attributes['work-experience'];
        $educations = $this->attributes['education'];
        $personalStat = $this->attributes['personal-statement'][0];
        ob_start();
        ?>
        <hr>
        <div class="resume-body">
            <div class="row">
                <div class="resume-main col-12 col-lg-8 col-xl-9   pe-0   pe-lg-5">
                    <section class="work-section py-3">
                        <h3 class="text-uppercase resume-section-heading mb-4">Work Experiences</h3>
                        <?php foreach ($workExperiences as $workExperience): ?>
                            <div class="item mb-3">
                                <div class="item-heading row align-items-center mb-2">
                                    <h4 class="item-title col-12 col-md-6 col-lg-8 mb-2 mb-md-0">
                                        <?= $workExperience['job_title'] ?></h4>
                                    <div
                                            class="item-meta col-12 col-md-6 col-lg-4 text-muted text-start text-md-end">
                                        <?= $workExperience['company_name'] ?> | <?= $workExperience['from_date'] ?> -
                                        <?= $workExperience['to_date'] ?? 'now' ?></div>
                                </div>
                                <div class="item-content">
                                    <p><?= $workExperience['description'] ?></p>
                                    <p>Hours per day: <?= $workExperience['hours'] ?? '-' ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </section>
                    <section class="project-section py-3">
                        <h3 class="text-uppercase resume-section-heading mb-4">Education</h3>
                        <div class="item mb-3">
                            <?php foreach ($educations as $education): ?>
                                <div class="item mb-3">
                                    <div class="item-heading row align-items-center mb-2">
                                        <h4 class="item-title col-12 col-md-6 col-lg-8 mb-2 mb-md-0">
                                            <?= $education['education'] ?></h4>
                                        <div
                                                class="item-meta col-12 col-md-6 col-lg-4 text-muted text-start text-md-end">
                                            <?= $education['facility_name'] ?> |
                                            <?= $education['start_date'] ?> -
                                            <?= $education['end_date']  ?? 'now' ?>
                                        </div>
                                        <div class="item-content">
                                            <p><?= $education['description'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </section>
                </div>
                <aside class="resume-aside col-12 col-lg-4 col-xl-3 px-lg-4 pb-lg-4">
                    <section class="skills-section py-3">
                        <h3 class="text-uppercase resume-section-heading mb-4">Skills</h3>
                        <div class="item">
                            <ul class="list-unstyled resume-skills-list">
                                <?= $personalStat['skills'] ?>
                            </ul>
                        </div>
                    </section>
                    <section class="skills-section py-3">
                        <h3 class="text-uppercase resume-section-heading mb-4">Languages</h3>
                        <ul class="list-unstyled resume-lang-list">
                            <?= $personalStat['languages'] ?>
                        </ul>
                    </section>
                    <section class="skills-section py-3">
                        <h3 class="text-uppercase resume-section-heading mb-4">Interests</h3>
                        <?= $personalStat['interests'] ?>
                        </ul>
                    </section>
                </aside>
            </div>
        </div>
        <?php
        $this->rows[] = ob_get_clean();
    }

    private function footer()
    {
        $social = $this->attributes['social'][0];
        ob_start();
        ?>
        <hr>
        <div class="resume-footer text-center">
            <ul class="resume-social-list list-inline mx-auto mb-0 d-inline-block text-muted">
                <?php if ($social['github']): ?>
                    <li class="list-inline-item mb-lg-0 me-3"><a class="resume-link" target="_blank" href="<?= 'https://github.com/'.$social['github'] ?>"><i
                                    class="fab fa-github-square fa-2x me-2" data-fa-transform="down-4"></i><span
                                    class="d-none d-lg-inline-block text-muted"><?= $social['github'] ?></span></a></li>
                <?php endif;
                if ($social['linkedin']):
                    ?>
                    <li class="list-inline-item mb-lg-0 me-3"><a class="resume-link" target="_blank" href="<?= 'https://linkedin.com/in/'.$social['linkedin'] ?>"><i
                                    class="fab fa-linkedin fa-2x me-2" data-fa-transform="down-4"></i><span
                                    class="d-none d-lg-inline-block text-muted"><?= $social['linkedin'] ?></span></a></li>
                <?php endif ?>
            </ul>
        </div>
        <?php
        $this->rows[] = ob_get_clean();
    }
}