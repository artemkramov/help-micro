<?php

use yii\helpers\Html;

/**
 * @var string $template
 * @var array $data
 */

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title><?php echo Yii::$app->name ?></title>
</head>
<body marginleft="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
<div id="wrapper" style="background-color: #f5f5f5;
    margin: 0;
    padding: 70px 0 70px 0;
    -webkit-text-size-adjust: none !important;
    width: 100%;">
    <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
        <tbody>
            <tr>
                <td align="center" valign="top">
                    <table border="0" cellpadding="0" cellspacing="0" width="600" id="template-container"
                           style="box-shadow: 0 1px 4px rgba(0,0,0,0.1) !important;
                                    background-color: #fdfdfd;
                                    border: 1px solid #dcdcdc;
                                    border-radius: 3px !important;">
                        <tbody>
                        <tr>
                            <td align="center" valign="top">
                                <!-- HEADER -->
                                <? echo $this->render('header', [
                                ]); ?>
                                <!-- END HEADER  -->
                            </td>
                        </tr>
                        <tr>
                            <td align="center" valign="top">
                                <!-- BODY -->
                                <table border="0" cellspacing="0" cellpadding="0" width="600" id="template-body">
                                    <tbody>
                                    <tr>
                                        <td valign="top" id="body-content" style="background-color: #fdfdfd;">
                                            <!-- CONTENT -->
                                            <?= $this->render($template, $data); ?>
                                            <!-- END CONTENT -->
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <!-- END BODY -->
                            </td>
                        </tr>
                        <tr>
                            <td align="center" valign="top">
                                <!-- FOOTER -->
                                <? echo $this->render('footer', [
                                ]); ?>
                                <!-- END FOOTER -->
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </td>
            </tr>

        </tbody>
    </table>
</div>

</body>
</html>