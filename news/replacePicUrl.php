<?php
/**
 * Created by PhpStorm.
 * User: Zhangbaili
 * Date: 2022/5/27
 * Time: 22:46
 */

class replacePicUrl
{
    public static function replace($content=null,$strUrl=null){
        if ($strUrl) {
            //提取图片路径的src的正则表达式 并把结果存入$matches中
            preg_match_all("/<img(.*)src=\"([^\"]+)\"[^>]+>/isU",$content,$matches);
            $img = "";
            if(!empty($matches)) {
                //注意，上面的正则表达式说明src的值是放在数组的第三个中
                $img = $matches[2];
            }else {
                $img = "";
            }
            if (!empty($img)) {
                $patterns= array();
                $replacements = array();
                foreach($img as $imgItem){
                    $final_imgUrl = $strUrl.$imgItem;
                    $replacements[] = $final_imgUrl;
                    $img_new = "/".preg_replace("/\//i","\/",$imgItem)."/";
                    $patterns[] = $img_new;
                }
                //让数组按照key来排序
                ksort($patterns);
                ksort($replacements);
                //替换内容
                $vote_content = preg_replace($patterns, $replacements, $content);
                return $vote_content;
            }else {
                return $content;
            }
        } else {
            return $content;
        }
    }

}