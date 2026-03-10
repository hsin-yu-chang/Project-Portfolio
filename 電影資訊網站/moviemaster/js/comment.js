// star choose
jQuery.fn.rater	= function(options) {
		
	// 暺䁅恕���㺭
	var settings = {
		enabled	: true,
		url		: '',
		method	: 'post',
		min		: 1,
		max		: 5,
		step	: 1,
		value	: null,
		after_click	: null,
		before_ajax	: null,
		after_ajax	: null,
		title_format	: null,
		info_format	: null,
		image	: 'images/comment/stars.jpg',
		imageAll :'images/comment/stars-all.gif',
		defaultTips :true,
		clickTips :true,
		width	: 24,
		height	: 24
	}; 
	
	// �䌊摰帋�匧��㺭
	if(options) {  
		jQuery.extend(settings, options); 
	}
	
	//憭硋捆�膥
	var container	= jQuery(this);
	
	// 銝餃捆�膥
	var content	= jQuery('<ul class="rater-star"></ul>');
	content.css('background-image' , 'url(' + settings.image + ')');
	content.css('height' , settings.height);
	content.css('width' , (settings.width*settings.step) * (settings.max-settings.min+settings.step)/settings.step);
	//�遬蝷箇�𤘪�𨅯躹���
	var result= jQuery('<div class="rater-star-result"></div>');
	container.after(result); 
	//�遬蝷箇�孵稬��鞟內
	var clickTips= jQuery('<div class="rater-click-tips"><span>�孵稬����笔停�虾隞亥���鈭�</span></div>');
		if(!settings.clickTips){
			clickTips.hide();	
		}
	container.after(clickTips); 
	//暺䁅恕��见耦��鞟內
	var tipsItem= jQuery('<li class="rater-star-item-tips"></li>');
	tipsItem.css('width' , (settings.width*settings.step) * (settings.max-settings.min+settings.step)/settings.step);
	tipsItem.css('z-index' , settings.max / settings.step + 2);
		if(!settings.defaultTips){	//��鞱�誯�䁅恕����鞟內
			tipsItem.hide();
		}
	content.append(tipsItem);
	// 敶枏�漤�劐葉��
	var item	= jQuery('<li class="rater-star-item-current"></li>');
	item.css('background-image' , 'url(' + settings.image + ')');
	item.css('height' , settings.height);
	item.css('width' , 0);
	item.css('z-index' , settings.max / settings.step + 1);
	if (settings.value) {
		item.css('width' , ((settings.value-settings.min)/settings.step+1)*settings.step*settings.width);
	};
	content.append(item);

	
	// �����
	for (var value=settings.min ; value<=settings.max ; value+=settings.step) {
		item	= jQuery('<li class="rater-star-item"><div class="popinfo"></div></li>');
		if (typeof settings.info_format == 'function') {
			//item.attr('title' , settings.title_format(value));
			item.find(".popinfo").html(settings.info_format(value));
			item.find(".popinfo").css("left",(value-1)*settings.width)
		}
		else {
			item.attr('title' , value);
		}
		item.css('height' , settings.height);
		item.css('width' , (value-settings.min+settings.step)*settings.width);
		item.css('z-index' , (settings.max - value) / settings.step + 1);
		item.css('background-image' , 'url(' + settings.image + ')');
		
		if (!settings.enabled) {	// �𥅾�糓銝滩�賣凒�㺿嚗��䠷�鞱��
			item.hide();
		}
		
		content.append(item);
	}
	
	content.mouseover(function(){
		if (settings.enabled) {
			jQuery(this).find('.rater-star-item-current').hide();
		}
	}).mouseout(function(){
			jQuery(this).find('.rater-star-item-current').show();
	})
	// 瘛餃�𣳇�䭾���砍��/�孵稬鈭衤辣
	var shappyWidth=(settings.max-2)*settings.width;
	var happyWidth=(settings.max-1)*settings.width;
	var fullWidth=settings.max*settings.width;
	content.find('.rater-star-item').mouseover(function() {
		jQuery(this).prevAll('.rater-star-item-tips').hide();
		jQuery(this).attr('class' , 'rater-star-item-hover');
		jQuery(this).find(".popinfo").show();
		
		//敶�3���𧒄�鍂蝚𤏸�貉”蝷�
		if(parseInt(jQuery(this).css("width"))==shappyWidth){
			jQuery(this).addClass('rater-star-happy');
		}
		//敶�4���𧒄�鍂蝚𤏸�貉”蝷�
		if(parseInt(jQuery(this).css("width"))==happyWidth){
			jQuery(this).addClass('rater-star-happy');
		}
		//敶�5���𧒄�鍂蝚𤏸�貉”蝷�
		if(parseInt(jQuery(this).css("width"))==fullWidth){
			jQuery(this).removeClass('rater-star-item-hover');
			jQuery(this).css('background-image' , 'url(' + settings.imageAll + ')');
			jQuery(this).css({cursor:'pointer',position:'absolute',left:'0',top:'0'});
		}
	}).mouseout(function() {
		var outObj=jQuery(this);
		outObj.css('background-image' , 'url(' + settings.image + ')');
		outObj.attr('class' , 'rater-star-item');
		outObj.find(".popinfo").hide();
		outObj.removeClass('rater-star-happy');
		jQuery(this).prevAll('.rater-star-item-tips').show();
		//var startTip=function () {
		//outObj.prevAll('.rater-star-item-tips').show();
		//};
		//startTip();
	}).click(function() {
		//jQuery(this).prevAll('.rater-star-item-tips').css('display','none');
		jQuery(this).parents(".rater-star").find(".rater-star-item-tips").remove();
		jQuery(this).parents(".goods-comm-stars").find(".rater-click-tips").remove();
		jQuery(this).prevAll('.rater-star-item-current').css('width' , jQuery(this).width());
		   if(parseInt(jQuery(this).prevAll('.rater-star-item-current').css("width"))==happyWidth||parseInt(jQuery(this).prevAll('.rater-star-item-current').css("width"))==shappyWidth){	
			jQuery(this).prevAll('.rater-star-item-current').addClass('rater-star-happy');
			}
		else{
			jQuery(this).prevAll('.rater-star-item-current').removeClass('rater-star-happy');
			}
			if(parseInt(jQuery(this).prevAll('.rater-star-item-current').css("width"))==fullWidth){	
			jQuery(this).prevAll('.rater-star-item-current').addClass('rater-star-full');
			}
		else{
			jQuery(this).prevAll('.rater-star-item-current').removeClass('rater-star-full');
			}
		var star_count		= (settings.max - settings.min) + settings.step;
		var current_number	= jQuery(this).prevAll('.rater-star-item').size()+1;
		var current_value	= settings.min + (current_number - 1) * settings.step;
		
		//�遬蝷箏�枏�滚���
		if (typeof settings.title_format == 'function') {
			jQuery(this).parents().nextAll('.rater-star-result').html(current_value+'��&nbsp;'+settings.title_format(current_value));
		}
		$("#StarNum").val(current_value);
		//jQuery(this).parents().next('.rater-star-result').html(current_value);
		//jQuery(this).unbind('mouseout',startTip)
	})
	
	jQuery(this).html(content);
	
}

// ������枏�
$(function(){
	var options	= {
	max	: 5,
	title_format	: function(value) {
		var title = '';
		switch (value) {
			case 1 : 
				title	= '敺��齿說��';
				break;
			case 2 : 
				title	= '銝齿說��';
				break;
			case 3 : 
				title	= '銝���';
				break;
			case 4 : 
				title	= '皛⊥��';
				break;
			case 5 : 
				title	= '��𧼮虜皛⊥��';
				break;
			default :
				title = value;
				break;
		}
		return title;
	},
	info_format	: function(value) {
		var info = '';
		switch (value) {
			case 1 : 
				info	= '<div class="info-box">1��&nbsp;敺��齿說��<div>�����甅撘誩�諹捶��誯�賡�𧼮虜撌殷��云隞支犖憭望�𥕢�嚗�</div></div>';
				break;
			case 2 : 
				info	= '<div class="info-box">2��&nbsp;銝齿說��<div>�����甅撘誩�諹捶��譍�滚末嚗䔶�滩�賣說頞唾�瘙���</div></div>';
				break;
			case 3 : 
				info	= '<div class="info-box">3��&nbsp;銝���<div>�����甅撘誩�諹捶��𤩺�蠘�劐�����</div></div>';
				break;
			case 4 : 
				info	= '<div class="info-box">4��&nbsp;皛⊥��<div>�����甅撘誩�諹捶��誯�賣�磰�皛⊥�𧶏�𣬚泵����𤑳�����䜘��</div></div>';
				break;
			case 5 : 
				info	= '<div class="info-box">5��&nbsp;��𧼮虜皛⊥��<div>��穃���𨀣洽嚗������甅撘誩�諹捶��誯�賢��說�𧶏��云璉雴�嚗�</div></div>';
				break;
			default :
				info = value;
				break;
		}
			return info;
		}
	}
	$('#rate-comm-1').rater(options);
});