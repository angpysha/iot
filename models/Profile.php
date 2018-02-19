<?php
/**
 * This is the model class for table "profile".
 *
 * @property string $uid
 */
    namespace app\models;

    class Profile extends \dektrium\user\models\Profile
    {
        /**
         * @var string
         */
        //public $uid;
        /**
         * @inheritdoc
         */
		public function rules()
		{
			return [
				['uid', 'string'],
			];
		}

		/**
		 * @inheritdoc
		 */
		public function attributeLabels()
		{
			return [
				'uid'           => \Yii::t('user', 'RFID ID'),
			];
		}
		
		
		
    }