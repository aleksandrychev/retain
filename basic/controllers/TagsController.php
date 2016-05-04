<?php

namespace app\controllers;

use app\models\ar\SentencesPlusHl;
use yii\filters\AccessControl;
use app\models\ar\TagsResult;
use app\models\logic\EntityDateSetter;
use Yii;
use app\models\ar\Tags;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TagsController implements the CRUD actions for Tags model.
 */
class TagsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'matchCallback' => function () {
                            return !\Yii::$app->user->getIsGuest();
                        },
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Tags models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tags::find()->where(['user' => Yii::$app->user->id]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tags model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        if ($model->user != Yii::$app->user->id) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Tags model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tags();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->user = Yii::$app->user->id;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Tags model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->user != Yii::$app->user->id) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Tags model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->user == Yii::$app->user->id) {
            $model->delete();
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }


        return $this->redirect(['index']);
    }

    public function actionSaveAdditionalData()
    {
        if ($_POST['id'] AND !empty($_POST['id'])) {
            $tagsResult = SentencesPlusHl::find()->where(['=', 'id', $_POST['id']])->one();
        } else {
            return json_encode(['error' => '1']);
        }
        if ($tagsResult && $_POST['field'] && $tagsResult->hasAttribute($_POST['field'])) {
            $tagsResult->$_POST['field'] = $_POST['data'];
            if ($tagsResult->save()) {
                return json_encode(['success' => 'true']);
            } else {
                return json_encode(['error' => '2', 'message' => $_POST['field'] . ' did\'nt saved']);
            }
        } else {
            return json_encode(['error' => '3']);
        }


    }

    public function actionSelectionProcess()
    {
        $selection = $_POST['selection'];

        if (!empty($selection) AND is_array($selection)) {
            $tagsResult = new SentencesPlusHl();
            $tagsResult->doc_id = $_POST['doc_id'];
            $tagsResult->user_id = \Yii::$app->user->id;
            $tagsResult->sent_hl = strip_tags(str_replace('div></div', 'div> </div',$selection['html']));
            $tagsResult->selection = $selection['html'];
            $tagsResult->page_number = $selection['page'];
            $tagsResult->line_number = $selection['line_number'];
            $tagsResult->tag_type = 1;
            $tagsResult->tag_id = $_POST['tag_id'];
            $selection['position']['selector'] = $selection['page_selector'];
            $tagsResult->positions = json_encode($selection['position']);

            if ($tagsResult->save()) {
                $tagsResult->entity_type = $tagsResult->tag->title;
                $tagsResult->save();

                $highlightModel = new EntityDateSetter($tagsResult, $tagsResult->doc_id);
                $highlightModel->process();


                echo $this->renderPartial('../documents/sidebar', ['docId' => $tagsResult->doc_id]);
            } else {
                echo json_encode(['error' => 'Something went wrong']);
            }

        } else {
            echo json_encode(['error' => 'Selection must be dosen\'t  empty']);
        }

    }

    /**
     * Finds the Tags model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tags the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tags::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
