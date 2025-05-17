<?php

namespace backend\controllers;

use common\models\Flyers;
use backend\models\FlyersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;


/**
 * FlyersController implements the CRUD actions for Flyers model.
 */
class FlyersController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create','update','delete'],
                        'roles' => ['admin'],
                        'allow' => true,
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Flyers models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new FlyersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Flyers model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Flyers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Flyers();

        if ($model->load(Yii::$app->request->post())) {
            $model->uploadFile = UploadedFile::getInstance($model, 'uploadFile');
            if ($model->validate()) {
                if ($model->uploadFile !== null) {
                    $fileName = 'flyer_' . time() . '.' . $model->uploadFile->extension;
                    $uploadPath = Yii::getAlias('@frontend/web/uploads/') . $fileName;
                    if ($model->uploadFile->saveAs($uploadPath)) {
                        $model->image_path = '/uploads/' . $fileName;
                    } else {
                        Yii::$app->session->setFlash('error', 'Upload failed. Check folder permissions.');
                    }
                }

                if ($model->save(false)) {
                    //to save in flyer-location table
                    $model->locationIds = Yii::$app->request->post('Flyers')['locationIds'] ?? [];
                    $model->unlinkAll('locations', true);
                    foreach ($model->locationIds as $locationId) {
                        $location = \common\models\Locations::findOne($locationId);
                        if ($location) {
                            $model->link('locations', $location);
                        }
                    }
                    //to save in flyer-product table
                    $model->productIds = Yii::$app->request->post('Flyers')['productIds'] ?? [];
                    $model->unlinkAll('products', true);
                    foreach ($model->productIds as $productId) {
                        $product = \common\models\Products::findOne($productId);
                        if ($product) {
                            $model->link('products', $product);
                        }
                    }

                    return $this->redirect(Yii::$app->request->referrer);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }


    /**
     * Updates an existing Flyers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
{
    $model = $this->findModel($id);

    if ($model->load(Yii::$app->request->post())) {
        $model->uploadFile = UploadedFile::getInstance($model, 'uploadFile');

        if ($model->validate()) {
            if ($model->uploadFile !== null) {
                $fileName = 'flyer_' . time() . '.' . $model->uploadFile->extension;
                $uploadPath = Yii::getAlias('@frontend/web/uploads/') . $fileName;

                if ($model->uploadFile->saveAs($uploadPath)) {
                    $model->image_path = '/uploads/' . $fileName;
                } else {
                    Yii::$app->session->setFlash('error', 'Upload failed. Check folder permissions.');
                }
            }

            if ($model->save(false)) {
                // Update flyer-location relations
                $model->locationIds = Yii::$app->request->post('Flyers')['locationIds'] ?? [];
                $model->unlinkAll('locations', true);
                foreach ($model->locationIds as $locationId) {
                    $location = \common\models\Locations::findOne($locationId);
                    if ($location) {
                        $model->link('locations', $location);
                    }
                }

                // Update flyer-product relations
                $model->productIds = Yii::$app->request->post('Flyers')['productIds'] ?? [];
                $model->unlinkAll('products', true);
                foreach ($model->productIds as $productId) {
                    $product = \common\models\Products::findOne($productId);
                    if ($product) {
                        $model->link('products', $product);
                    }
                }

                return $this->redirect(Yii::$app->request->referrer);
            }
        }
    }

    $model->locationIds = ArrayHelper::getColumn($model->locations, 'id');
    $model->productIds = ArrayHelper::getColumn($model->products, 'id');

    return $this->renderAjax('update', [
        'model' => $model,
    ]);
}


    /**
     * Deletes an existing Flyers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Flyers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Flyers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Flyers::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
