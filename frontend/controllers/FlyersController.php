<?php

namespace frontend\controllers;

use common\models\Flyers;
use frontend\models\FlyersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use Mpdf\Mpdf;
use Yii;
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
                        'actions' => [  'download', 'index','view','compare'],
                        'roles' => ['client'],
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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionDownload($id)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        $flyer = Flyers::findOne($id);
        if (!$flyer) {
            throw new NotFoundHttpException("Flyer not found.");
        }

        $content = $this->renderPartial('download_pdf', ['flyer' => $flyer]);

        $mpdf = new Mpdf();
        $mpdf->WriteHTML($content);

        return Yii::$app->response->sendContentAsFile(
            $mpdf->Output('', \Mpdf\Output\Destination::STRING_RETURN),
            'Flyer_' . $flyer->title . '.pdf',
            ['mimeType' => 'application/pdf']
        );
    }
    public function actionCompare($id)
    {
        $flyer1 = Flyers::findOne($id);
        $flyer2Id = Yii::$app->request->get('with');
        $flyer2 = $flyer2Id ? Flyers::findOne($flyer2Id) : null;

        $allFlyers = Flyers::find()->where(['<>', 'id', $id])->all();

        return $this->render('compare', [
            'flyer1' => $flyer1,
            'flyer2' => $flyer2,
            'flyerOptions' => $allFlyers,
        ]);
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
