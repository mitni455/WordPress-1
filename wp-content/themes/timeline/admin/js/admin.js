/*!
	jQuery Cookie Plugin
	https://github.com/carhartl/jquery-cookie
	
	Copyright 2011, Klaus Hartl
	Dual licensed under the MIT or GPL Version 2 licenses.
	http://www.opensource.org/licenses/mit-license.php
	http://www.opensource.org/licenses/GPL-2.0
*/
(function(a){a.cookie=function(b,c,d){if(arguments.length>1&&(!/Object/.test(Object.prototype.toString.call(c))||c===null||c===undefined)){d=a.extend({},d);if(c===null||c===undefined){d.expires=-1}if(typeof d.expires==="number"){var e=d.expires,f=d.expires=new Date;f.setDate(f.getDate()+e)}c=String(c);return document.cookie=[encodeURIComponent(b),"=",d.raw?c:encodeURIComponent(c),d.expires?"; expires="+d.expires.toUTCString():"",d.path?"; path="+d.path:"",d.domain?"; domain="+d.domain:"",d.secure?"; secure":""].join("")}d=c||{};var g=d.raw?function(a){return a}:decodeURIComponent;var h=document.cookie.split("; ");for(var i=0,j;j=h[i]&&h[i].split("=");i++){if(g(j[0])===b)return g(j[1]||"")}return null}})(jQuery)

/*
	STOP
	-------------------------------
	Serifly Theme Options Panel 1.1
	Updated on October 27th, 2012
	http://serifly.com
	
	Copyright (c) 2012 Serifly.com
*/

jQuery(function($)
{
	// Retrieve panel from cookie if set
	if ($.cookie('theme_options_panel') !== null)
	{
		var showPanel = $.cookie('theme_options_panel');
	}
	
	if (typeof showPanel == 'undefined' || $('#' + showPanel).length == 0)
	{
		var showPanel = $('#theme_options_panel').val();
	}
	
	// Show current panel
	$('div.stopWrap ul.stopNavigation li').removeClass('active');
	$('div.stopWrap ul.stopNavigation li a[href$="' + showPanel + '"]').parent().addClass('active');
	$('div.stopWrap div.stopContent').hide();
	$('#' + showPanel).show();
	
	// Bind panel navigation
	$('div.stopWrap ul.stopNavigation li a').click(function()
	{
		$('ul.stopNavigation li').removeClass('active');
		$(this).parent().addClass('active');
				
		var callItem = $(this).attr('href');
		
		$('div.stopContent:visible').animate({ opacity: 'hide' }, 100, function()
		{
			$(callItem).animate({ opacity: 'show' }, 100);
			$('#theme_options_panel').val(callItem.replace('#', ''));
			$.cookie('theme_options_panel', callItem.replace('#', ''), { path: '/' });
		});
		
		return false;
	});
	
	// Success Notification
	var fadeElement = $('div.stopWrap .fade');
	if (fadeElement.length != 0)
	{
		fadeElement.show().delay(3000).animate({ marginTop: '-' + (fadeElement.height() + 2) + 'px', opacity: 'hide' }, 300);
	}
	
	// Image upload
	$('div.stopWrap input.image_upload').click(function()
	{
		var imageTarget = $(this).parent().find('input[type="text"]');
		var formField = imageTarget.attr('name');
		tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true');
		
		window.send_to_editor = function(html)
		{
			if ($(html).is('img'))
			{
				var imageUrl = $(html).attr('src');
			}
			else
			{
				var imageUrl = $('img', html).attr('src');
			}
						
			imageTarget.parent().parent().find('div.preview_image').show().find('img').attr('src', imageUrl);
			imageTarget.val(imageUrl);
			tb_remove();
		}
		
		return false;
	});
		
	// Colorpicker
	var colorpicker = $('div.stopWrap div.colorpicker');
	if (colorpicker.length != 0)
	{	
		colorpicker.each(function()
		{
			$(this).find('div.colorpickerWrap').farbtastic('#' + $(this).find('input[type="text"]').attr('id')); 
		});
		
		colorpicker.find('input[type="text"]').focus(function()
		{
			$(this).parent().find('div.colorpickerWrap').animate({ marginTop: '4px', opacity: 'show' }, 200);
		});
		
		colorpicker.find('input[type="text"]').blur(function()
		{
			$(this).parent().find('div.colorpickerWrap').animate({ marginTop: '-12px', opacity: 'hide' }, 200);
		});
	}
	
	// Handle reset click
	$('div.stopWrap div.reset input').click(function()
	{
		if (!confirm('Warning, all your options will be deleted. Do you really want to continue?'))
		{
			return false;
		}
	});
});