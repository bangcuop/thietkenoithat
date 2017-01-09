<?php

namespace common\models\db;

use common\models\enu\ImageType;
use common\models\output\Response;
use common\util\TextUtils;
use Yii;
use yii\db\ActiveRecord;
use yii\elasticsearch\Exception;

/**
 * This is the model class for table "image".
 *
 * @property integer $id
 * @property string $targetId
 * @property integer $position
 * @property string $type
 * @property integer $width
 * @property integer $height
 * @property string $extension
 * @property string $imageId
 */
class Image extends ActiveRecord {

    private static $root;
    private static $baseUrl;
    private static $level;
    private static $alias;

    public static function __init() {
        $config = Yii::$app->params['image'];
        self::$root = $config['root'];
        self::$baseUrl = $config['baseUrl'];
        self::$level = $config['level'];
        self::$alias = Yii::getAlias("@backend/media");
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'image';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['targetId', 'extension', 'imageId'], 'required'],
            [['position', 'width', 'height'], 'integer'],
            [['targetId', 'imageId'], 'string', 'max' => 220],
            [['type'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'targetId' => Yii::t('app', 'Target ID'),
            'position' => Yii::t('app', 'Position'),
            'type' => Yii::t('app', 'Type'),
            'width' => Yii::t('app', 'Width'),
            'height' => Yii::t('app', 'Height'),
            'imageId' => Yii::t('app', 'Image ID'),
        ];
    }

    /**
     * Gen name
     * @param type $name
     * @param type $imageType
     * @return type
     */
    private static function genName($name, $imageType) {
        $explode = explode(".", trim(str_replace(" ", "-", TextUtils::removeMarks($name))));
        $imgT = explode("/", $imageType);
        return $explode[0] . "-" . time() . "." . $imgT[1];
    }

    /**
     * thumb ảnh
     * @param Image $image
     * @param type $thumbnail
     */
    private static function thumbnail($iPath, Image $image, $thumbnail) {
        if (!empty($thumbnail) && is_array($thumbnail) && !empty($image)) {
            foreach ($thumbnail as $thum) {
                if (!empty($thum) && is_array($thum)) {
                    $path = preg_replace("/target_(.*)\//", "target_" . $image->targetId . "/" . $thum[0] . "x" . $thum[1] . "_", $iPath);
                    \yii\imagine\Image::thumbnail($iPath, $thum[0], $thum[1])->save($path);
                }
            }
        }
    }

    /**
     * resize ảnh
     * @param Image $image
     * @param type $thumbnail
     */
    private static function resize($iPath, $size) {
        if (!empty($size) && is_array($size)) {
            \yii\image\drivers\Image_Imagick::factory($iPath)->resize($size[0], $size[1])->save();
        }
    }

    /**
     * save image
     * @param type $name
     * @param type $type
     * @param type $targetId
     * @param type $position
     * @return Response
     */
    public static function iSave($name, $type, $targetId, $position = 0, $extension = 'jpg') {
        $image = new self();
        $image->targetId = $targetId;
        $image->position = $position;
        $image->type = $type;
        $image->imageId = strtolower($name);
        $image->extension = $extension;
        if (!$image->save()) {
            return new Response(false, "Thêm ảnh không thành công", $image->errors);
        }
        return new Response(true, "Thêm ảnh thành công", $image);
    }

    /**
     * Dowload ảnh
     * @param type $url
     * @param type $type
     * @param type $targetId
     * @param type $position
     * @param type $thumbnail
     * @return type
     * @throws Exception
     */
    public static function dowload($url, $type = ImageType::_DEFAULT, $targetId = '1', $position = 1, $thumbnail = [], $name = null) {
        self::__init();
        try {
            $imageType = get_headers($url, 1)["Content-Type"];
            $imgT = explode("/", $imageType);
            if ($imgT[0] != 'image') {
                throw new Exception("Địa chỉ không phải là ảnh, không thể thêm ảnh");
            }
            $image = explode("/", $url);
            $path = '/' . strtolower($type) . '/target_' . $targetId . '/' . self::genName(empty($name) ? end($image) : $name, $imageType);
            $image = TextUtils::randomPathfile(self::$alias . '/' . strtolower($type) . '/target_' . $targetId . '/', 0, false) . self::genName(empty($name) ? end($image) : $name, $imageType);
            \yii\imagine\Image::frame($url, 0, '666', 0)->save($image);
            $resp = self::iSave($path, $type, $targetId, $position, $imgT[1]);
            if ($resp->success) {
                self::thumbnail($image, $resp->data, $thumbnail);
            }
            return $resp;
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage() . "(Line: " . $exc->getLine() . ", File: " . $exc->getFile() . ")");
        }
    }

    /**
     * Upload image
     * @param type $image
     * @param type $type
     * @param type $targetId
     * @param type $position
     * @param type $thumbnail
     * @return Response
     * @throws Exception
     */
    public static function upload($image, $type = ImageType::_DEFAULT, $targetId = '0', $position = 0, $thumbnail = [], $name = null) {
        self::__init();
        try {
            if (!is_object($image)) {
                return new Response(false, "Dữ liệu nhập vào không phải thông tin ảnh");
            }
            $imgT = explode("/", $image->type);
            if ($imgT[0] != 'image') {
                throw new Exception("Địa chỉ không phải là ảnh, không thể thêm ảnh");
            }
            $path = '/' . strtolower($type) . '/target_' . $targetId . '/' . self::genName(empty($name) ? $image->name : $name, $image->type);
            $imagePath = TextUtils::randomPathfile(self::$alias . '/' . strtolower($type) . '/target_' . $targetId . '/', 0, false) . self::genName(empty($name) ? $image->name : $name, $image->type);
            move_uploaded_file($image->tempName, $imagePath);
            $resp = self::isave($path, $type, $targetId, $position, $imgT[1]);
            if ($resp->success) {
                self::thumbnail($imagePath, $resp->data, $thumbnail);
//                self::resize($imagePath, [1980, 1320]);
            }
            return $resp;
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage() . "(Line: " . $exc->getLine() . ", File: " . $exc->getFile() . ")");
        }
    }

    /**
     * Danh sách ảnh theo target
     * @param type $condition
     * @param type $type
     * @param type $getUrl
     * @param type $baseUrl
     * @return string
     */
    public static function getByTarget($condition, $type = ImageType::_DEFAULT, $getUrl = false, $baseUrl = false, $thumbnail = []) {
        self::__init();
        $imgs = self::find()->andWhere(["targetId" => $condition, 'type' => $type])->all();
        if ($imgs == null || empty($imgs)) {
            return $imgs;
        }
        $url = [];
        foreach ($imgs as $img) {
            if (!isset($url[$img->targetId]) || $url[$img->targetId] == null) {
                $url[$img->targetId] = [];
            }
            $img->imageId = ($baseUrl == true ? self::$baseUrl : '') . $img->imageId;
            $url[$img->targetId][] = $img->imageId;
        }
        if ($getUrl) {
            return $url;
        }
        return $imgs;
    }

    /**
     * Xoá ảnh theo path
     * @param type $condition
     * @return boolean
     */
    public static function deleteByImageId($condition) {
        self::__init();
        self::deleteAll(["imageId" => $condition]);
        if (!is_array($condition)) {
            self::remove($condition);
            return true;
        }
        foreach ($condition as $imageId) {
            self::remove($imageId);
        }
        return true;
    }

    /**
     * Xoá ảnh theo path
     * @param type $imagePath
     * @return Response
     */
    public static function remove($imagePath) {
        $filePath = self::$alias . $imagePath;
        if (file_exists($filePath)) {
            unlink($filePath);
            return new Response(true, "Ảnh đã được xóa khỏi hệ thống");
        }
        return new Response(false, "Ảnh không tồn tại trên hệ thống");
    }

    /**
     * 
     * @param type $condition
     * @return boolean
     */
    public static function deleteByTarget($condition) {
        $images = Image::find()->andWhere(["targetId" => $condition])->all();
        $imageClient = new ImageClient();
        foreach ($images as $image) {
            $imageClient->deleteImage($image->imageId);
        }
        Image::deleteAll(["targetId" => $condition]);
        return true;
    }

}
