<?php
class messageType{
	public function text(){
			$text=	"<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                        <FuncFlag>0</FuncFlag>
                        </xml>";
			return $text;
	}
	
	public function image(){
			$image = 
                "<xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[news]]></MsgType>
                <ArticleCount>1</ArticleCount>
                <Articles>
                <item>
                <Title><![CDATA[测试回复图片模式]]></Title>
                <Description><![CDATA[终于能回复图片模式了！！！]]></Description>
                <PicUrl><![CDATA[http://1.lonking.sinaapp.com/php/1.jpg]]></PicUrl>
                <Url><![CDATA[http://wap.baidu.com/img?idx=20000&ssid=0&from=0&bd_page_type=1&uid=0&pu=sz%40224_220%2Cta%40middle___3_537&itj=21]]></Url>
                </item>
                <FuncFlag>0</FuncFlag>
                </xml>";
			return $image;
	}
	
	
}