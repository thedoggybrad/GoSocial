var Ossn=Ossn||{};Ossn.Startups=new Array();Ossn.hooks=new Array();Ossn.events=new Array();Ossn.RegisterStartupFunction=function($func){Ossn.Startups.push($func);};Ossn.Clk=function($elem){$($elem).trigger('click');};Ossn.str_replace=function(search,replace,subject,countObj){var i=0
var j=0
var temp=''
var repl=''
var sl=0
var fl=0
var f=[].concat(search)
var r=[].concat(replace)
var s=subject
var ra=Object.prototype.toString.call(r)==='[object Array]'
var sa=Object.prototype.toString.call(s)==='[object Array]'
s=[].concat(s)
var $global=(typeof window!=='undefined'?window:global)
$global.$locutus=$global.$locutus||{}
var $locutus=$global.$locutus
$locutus.php=$locutus.php||{}
if(typeof(search)==='object'&&typeof(replace)==='string'){temp=replace
replace=[]
for(i=0;i<search.length;i+=1){replace[i]=temp}
temp=''
r=[].concat(replace)
ra=Object.prototype.toString.call(r)==='[object Array]'}
if(typeof countObj!=='undefined'){countObj.value=0}
for(i=0,sl=s.length;i<sl;i++){if(s[i]===''){continue}
for(j=0,fl=f.length;j<fl;j++){temp=s[i]+''
repl=ra?(r[j]!==undefined?r[j]:''):r[0]
s[i]=(temp).split(f[j]).join(repl)
if(typeof countObj!=='undefined'){countObj.value+=((temp.split(f[j])).length-1)}}}
return sa?s:s[0];};Ossn.redirect=function($url){window.location=Ossn.site_url+$url;};Ossn.UrlParams=function(name,url){var results=new RegExp('[\\?&]'+name+'=([^&#]*)').exec(url);if(!results){return 0;}
return results[1]||0;};Ossn.ParseStr=function(string){var params={},result,key,value,re=/([^&=]+)=?([^&]*)/g,re2=/\[\]$/;while(result=re.exec(string)){key=decodeURIComponent(result[1].replace(/\+/g,' '));value=decodeURIComponent(result[2].replace(/\+/g,' '));if(re2.test(key)){key=key.replace(re2,'');if(!params[key]){params[key]=[];}
params[key].push(value);}else{params[key]=value;}}
return params;};Ossn.ParseUrl=function(url,component,expand){expand=expand||false;component=component||false;var re_str='^(?:(?![^:@]+:[^:@/]*@)([^:/?#.]+):)?(?://)?'
+'((?:(([^:@]*)(?::([^:@]*))?)?@)?'
+'([^:/?#]*)(?::(\\d*))?)'
+'(((/(?:[^?#](?![^?#/]*\\.[^?#/.]+(?:[?#]|$)))*/?)?([^?#/]*))'
+'(?:\\?([^#]*))?'
+'(?:#(.*))?)',keys={1:"scheme",4:"user",5:"pass",6:"host",7:"port",9:"path",12:"query",13:"fragment"},results={};if(url.indexOf('mailto:')===0){results['scheme']='mailto';results['path']=url.replace('mailto:','');return results;}
if(url.indexOf('javascript:')===0){results['scheme']='javascript';results['path']=url.replace('javascript:','');return results;}
var re=new RegExp(re_str);var matches=re.exec(url);for(var i in keys){if(matches[i]){results[keys[i]]=matches[i];}}
if(expand&&typeof(results['query'])!='undefined'){results['query']=Ossn.ParseStr(results['query']);}
if(component){if(typeof(results[component])!='undefined'){return results[component];}else{return false;}}
return results;};Ossn.isset=function($variable){if(typeof $variable!=='undefined'){return true;}
return false;};Ossn.call_user_func_array=function(cb,parameters){var $global=(typeof window!=='undefined'?window:global)
var func
var scope=null
var validJSFunctionNamePattern=/^[_$a-zA-Z\xA0-\uFFFF][_$a-zA-Z0-9\xA0-\uFFFF]*$/;if(typeof cb==='string'){if(typeof $global[cb]==='function'){func=$global[cb]}else if(cb.match(validJSFunctionNamePattern)){func=(new Function(null,'return '+cb)())}}else if(Object.prototype.toString.call(cb)==='[object Array]'){if(typeof cb[0]==='string'){if(cb[0].match(validJSFunctionNamePattern)){func=eval(cb[0]+"['"+cb[1]+"']")}}else{func=cb[0][cb[1]]}
if(typeof cb[0]==='string'){if(typeof $global[cb[0]]==='function'){scope=$global[cb[0]]}else if(cb[0].match(validJSFunctionNamePattern)){scope=eval(cb[0])}}else if(typeof cb[0]==='object'){scope=cb[0]}}else if(typeof cb==='function'){func=cb}
if(typeof func!=='function'){throw new Error(func+' is not a valid function')}
return func.apply(scope,parameters)};Ossn.is_callable=function(mixedVar,syntaxOnly,callableName){var $global=(typeof window!=='undefined'?window:global)
var validJSFunctionNamePattern=/^[_$a-zA-Z\xA0-\uFFFF][_$a-zA-Z0-9\xA0-\uFFFF]*$/;var name=''
var obj={}
var method=''
var validFunctionName=false
var getFuncName=function(fn){var name=(/\W*function\s+([\w$]+)\s*\(/).exec(fn)
if(!name){return'(Anonymous)'}
return name[1]}
if(/(^class|\(this\,)/.test(mixedVar.toString())){return false}
if(typeof mixedVar==='string'){obj=$global
method=mixedVar
name=mixedVar
validFunctionName=!!name.match(validJSFunctionNamePattern)}else if(typeof mixedVar==='function'){return true}else if(Object.prototype.toString.call(mixedVar)==='[object Array]'&&mixedVar.length===2&&typeof mixedVar[0]==='object'&&typeof mixedVar[1]==='string'){obj=mixedVar[0]
method=mixedVar[1]
name=(obj.constructor&&getFuncName(obj.constructor))+'::'+method}
if(syntaxOnly||typeof obj[method]==='function'){if(callableName){$global[callableName]=name}
return true}
if(validFunctionName&&typeof eval(method)==='function'){if(callableName){$global[callableName]=name}
return true}
return false}
Ossn.is_hook=function($hook,$type){if(Ossn.hooks[$hook]&&Ossn.hooks[$hook][$type]){return true;}
return false;}
Ossn.unset_hook=function($hook,$type,$callback){if($hook==''||$type==''||$callback==''){return false;}
if(Ossn.is_hook($hook,$type)){for(i=0;i<=Ossn.hooks[$hook][$type].length;i++){if(Ossn.isset(Ossn.hooks[$hook][$type][i])){if(Ossn.isset(Ossn.hooks[$hook][$type][i].hook)){if(Ossn.hooks[$hook][$type][i].hook==$callback){Ossn.hooks[$hook][$type].splice(i,1);break;}}}}}};Ossn.add_hook=function($hook,$type,$callback,$priority=200){if($hook==''||$type==''){return false;}
if(!Ossn.isset(Ossn.hooks)){Ossn.hooks=new Array();}
if(!Ossn.isset(Ossn.hooks[$hook])){Ossn.hooks[$hook]=new Array();}
if(!Ossn.isset(Ossn.hooks[$hook][$type])){Ossn.hooks[$hook][$type]=new Array();}
if(!Ossn.is_callable($callback,true)){return false;}
$priority=Math.max(parseInt($priority),0);Ossn.hooks[$hook][$type].push({'hook':$callback,'priority':$priority,});return true;};Ossn.call_hook=function($hook,$type,$params=null,$returnvalue=null){$hooks=new Array();hookspush=Array.prototype.push
if(Ossn.isset(Ossn.hooks[$hook])&&Ossn.isset(Ossn.hooks[$hook][$type])){hookspush.apply($hooks,Ossn.hooks[$hook][$type]);}
$hooks.sort(function(a,b){if(a.priority<b.priority){return-1;}
if(a.priority>b.priority){return 1;}
return(a.index<b.index)?-1:1;});$.each($hooks,function(index,$item){$value=Ossn.call_user_func_array($item.hook,[$hook,$type,$returnvalue,$params]);if(Ossn.isset($value)){$returnvalue=$value;}});return $returnvalue;};Ossn.is_callback=function($event,$type){if(Ossn.isset(Ossn.events[$event][$type])){return true;}
return false;}
Ossn.register_callback=function($event,$type,$callback,$priority=200){if($event==''||$type==''){return false;}
if(!Ossn.isset(Ossn.events)){Ossn.events=new Array();}
if(!Ossn.isset(Ossn.events[$event])){Ossn.events[$event]=new Array();}
if(!Ossn.isset(Ossn.events[$event][$type])){Ossn.events[$event][$type]=new Array();}
if(!Ossn.is_callable($callback,true)){return false;}
$priority=Math.max(parseInt($priority),0);Ossn.events[$event][$type].push({'callback':$callback,'priority':$priority,});return true;};Ossn.unset_callback=function($event,$type,$callback){if($event==''||$type==''||$callback==''){return false;}
if(Ossn.is_callback($event,$type)){for(i=0;i<=Ossn.events[$event][$type].length;i++){if(Ossn.isset(Ossn.events[$event][$type][i])){if(Ossn.isset(Ossn.events[$event][$type][i].callback)){if(Ossn.events[$event][$type][i].callback==$callback){Ossn.events[$event][$type].splice(i,1);break;}}}}}};Ossn.trigger_callback=function($event,$type,$params=null){$events=new Array();eventspush=Array.prototype.push
if(Ossn.isset(Ossn.events[$event])&&Ossn.isset(Ossn.events[$event][$type])){eventspush.apply($events,Ossn.events[$event][$type]);}else{return false;}
$events.sort(function(a,b){if(a.priority<b.priority){return-1;}
if(a.priority>b.priority){return 1;}
return(a.index<b.index)?-1:1;});$tempvalue=null;$.each($events,function(index,$item){if(Ossn.is_callable($item.callback)&&(Ossn.call_user_func_array($item.callback,[$event,$type,$params])==false)){return false;}});return true;};Ossn.setrawcookie=function(name,value,expires,path,domain,secure){if(typeof expires==='string'&&(/^\d+$/).test(expires)){expires=parseInt(expires,10)}
if(expires instanceof Date){expires=expires.toUTCString()}else if(typeof expires==='number'){expires=(new Date(expires*1e3)).toUTCString()}
var r=[name+'='+value],s={},i=''
s={expires:expires,path:path,domain:domain}
for(i in s){if(s.hasOwnProperty(i)){s[i]&&r.push(i+'='+s[i])}}
return secure&&r.push('secure'),window.document.cookie=r.join(';'),true};Ossn.setCookie=function(name,value,expires,path,domain,secure){return Ossn.setrawcookie(name,encodeURIComponent(value),expires,path,domain,secure)};Ossn.getCookie=function(name){var i=0,c='',nameEQ=name+'=',ca=document.cookie.split(';'),cal=ca.length;for(i=0;i<cal;i++){c=ca[i].replace(/^ */,'');if(c.indexOf(nameEQ)===0){return decodeURIComponent(c.slice(nameEQ.length).replace(/\+/g,'%20'));}}
return null;};Ossn.ajaxRequest=function($datap){$(function(){var $form_name=$datap['form'];$('body').on("submit",$form_name,function(event){var $data=Ossn.call_hook('ajax','request:settings',null,$datap);var url=$data['url'];var callback=$data['callback'];var error=$data['error'];var befsend=$data['beforeSend'];var action=$data['action'];var containMedia=$data['containMedia'];var $xhr=$data['xhr'];if(url==true){url=$($form_name).attr('action');}
event.preventDefault();event.stopImmediatePropagation();if(!callback){return false;}
if(!befsend){befsend=function(){}}
if(!action){action=false;}
if(action==true){url=Ossn.AddTokenToUrl(url);}
if(!error){error=function(xhr,status,error){if(error=='Internal Server Error'||error!==''){Ossn.MessageBox('syserror/unknown');}};}
if(!$xhr){$xhr=function(){var xhr=new window.XMLHttpRequest();return xhr;};}
var $form=$(this);if(containMedia==true){$requestData=new FormData($form[0]);$removeNullFile=function(formData){if(formData.keys){for(var key of formData.keys()){var fileName=null||formData.get(key)['name'];var fileSize=null||formData.get(key)['size'];if(fileName!=null&&fileSize!=null&&fileName==''&&fileSize==0){formData.delete(key);}}}};$removeNullFile($requestData);$vars={xhr:$xhr,async:true,cache:false,contentType:false,type:'post',beforeSend:befsend,url:url,error:error,data:$requestData,processData:false,success:callback,};}else{$vars={xhr:$xhr,async:true,type:'post',beforeSend:befsend,url:url,error:error,data:$form.serialize(),success:callback,};}
return $.ajax($vars);});});};Ossn.PostRequest=function($datap){var $data=Ossn.call_hook('ajax:post','request:settings',null,$datap);var url=$data['url'];var callback=$data['callback'];var error=$data['error'];var befsend=$data['beforeSend'];var $fdata=$data['params'];var async=$data['async'];var action=$data['action'];var $xhr=$data['xhr'];if(!callback){return false;}
if(!befsend){befsend=function(){}}
if(typeof async==='undefined'){async=true;}
if(!action){action=true;}
if(action==true){url=Ossn.AddTokenToUrl(url);}
if(!error){error=function(){};}
if(!$xhr){$xhr=function(){var xhr=new window.XMLHttpRequest();return xhr;};}
return $.ajax({xhr:$xhr,async:async,type:'post',beforeSend:befsend,url:url,error:error,data:$fdata,success:callback,});};Ossn.AddTokenToUrl=function(data){if(typeof data==='string'){var parts=Ossn.ParseUrl(data),args={},base='';if(parts['host']===undefined){if(data.indexOf('?')===0){base='?';args=Ossn.ParseStr(parts['query']);}}else{if(parts['query']!==undefined){args=Ossn.ParseStr(parts['query']);}
var split=data.split('?');base=split[0]+'?';}
args["ossn_ts"]=Ossn.Config.token.ossn_ts;args["ossn_token"]=Ossn.Config.token.ossn_token;return base+jQuery.param(args);}};var sprintf=(function(){function get_type(variable){return Object.prototype.toString.call(variable).slice(8,-1).toLowerCase();}
function str_repeat(input,multiplier){for(var output=[];multiplier>0;output[--multiplier]=input){}
return output.join('');}
var str_format=function(){if(!str_format.cache.hasOwnProperty(arguments[0])){str_format.cache[arguments[0]]=str_format.parse(arguments[0]);}
return str_format.format.call(null,str_format.cache[arguments[0]],arguments);};str_format.format=function(parse_tree,argv){var cursor=1,tree_length=parse_tree.length,node_type='',arg,output=[],i,k,match,pad,pad_character,pad_length;for(i=0;i<tree_length;i++){node_type=get_type(parse_tree[i]);if(node_type==='string'){output.push(parse_tree[i]);}else if(node_type==='array'){match=parse_tree[i];if(match[2]){arg=argv[cursor];for(k=0;k<match[2].length;k++){if(!arg.hasOwnProperty(match[2][k])){throw(sprintf('[sprintf] property "%s" does not exist',match[2][k]));}
arg=arg[match[2][k]];}}else if(match[1]){arg=argv[match[1]];}else{arg=argv[cursor++];}
if(/[^s]/.test(match[8])&&(get_type(arg)!='number')){throw(sprintf('[sprintf] expecting number but found %s',get_type(arg)));}
switch(match[8]){case'b':arg=arg.toString(2);break;case'c':arg=String.fromCharCode(arg);break;case'd':arg=parseInt(arg,10);break;case'e':arg=match[7]?arg.toExponential(match[7]):arg.toExponential();break;case'f':arg=match[7]?parseFloat(arg).toFixed(match[7]):parseFloat(arg);break;case'o':arg=arg.toString(8);break;case's':arg=((arg=String(arg))&&match[7]?arg.substring(0,match[7]):arg);break;case'u':arg=Math.abs(arg);break;case'x':arg=arg.toString(16);break;case'X':arg=arg.toString(16).toUpperCase();break;}
arg=(/[def]/.test(match[8])&&match[3]&&arg>=0?'+'+arg:arg);pad_character=match[4]?match[4]=='0'?'0':match[4].charAt(1):' ';pad_length=match[6]-String(arg).length;pad=match[6]?str_repeat(pad_character,pad_length):'';output.push(match[5]?arg+pad:pad+arg);}}
return output.join('');};str_format.cache={};str_format.parse=function(fmt){var _fmt=fmt,match=[],parse_tree=[],arg_names=0;while(_fmt){if((match=/^[^\x25]+/.exec(_fmt))!==null){parse_tree.push(match[0]);}else if((match=/^\x25{2}/.exec(_fmt))!==null){parse_tree.push('%');}else if((match=/^\x25(?:([1-9]\d*)\$|\(([^\)]+)\))?(\+)?(0|'[^$])?(-)?(\d+)?(?:\.(\d+))?([b-fosuxX])/.exec(_fmt))!==null){if(match[2]){arg_names|=1;var field_list=[],replacement_field=match[2],field_match=[];if((field_match=/^([a-z_][a-z_\d]*)/i.exec(replacement_field))!==null){field_list.push(field_match[1]);while((replacement_field=replacement_field.substring(field_match[0].length))!==''){if((field_match=/^\.([a-z_][a-z_\d]*)/i.exec(replacement_field))!==null){field_list.push(field_match[1]);}else if((field_match=/^\[(\d+)\]/.exec(replacement_field))!==null){field_list.push(field_match[1]);}else{throw('[sprintf] huh?');}}}else{throw('[sprintf] huh?');}
match[2]=field_list;}else{arg_names|=2;}
if(arg_names===3){throw('[sprintf] mixing positional and named placeholders is not (yet) supported');}
parse_tree.push(match);}else{throw('[sprintf] huh?');}
_fmt=_fmt.substring(match[0].length);}
return parse_tree;};return str_format;})();var vsprintf=function(fmt,argv){argv.unshift(fmt);return sprintf.apply(null,argv);};Ossn.Print=function(str,args){if(OssnLocale[str]){if(!args){return OssnLocale[str];}else{return vsprintf(OssnLocale[str],args);}}
return str;};Ossn.isLangString=function(str,args){if(OssnLocale[str]){return true;}
return false;};Ossn.MessageBoxClose=function(){$('.ossn-message-box').hide();$('.ossn-halt').removeClass('ossn-light').hide();$('.ossn-halt').attr('style','');};Ossn.MessageBox=function($url){Ossn.PostRequest({url:Ossn.site_url+$url,beforeSend:function(){$('.ossn-halt').addClass('ossn-light');$('.ossn-halt').attr('style','height:'+$(document).height()+'px;');$('.ossn-halt').show();$('.ossn-message-box').html('<div class="ossn-loading ossn-box-loading"></div>');$('.ossn-message-box').fadeIn('slow');},callback:function(callback){$('.ossn-message-box').html(callback).fadeIn();},});};Ossn.Viewer=function($url){Ossn.PostRequest({url:Ossn.site_url+$url,beforeSend:function(){$('.ossn-halt').removeClass('ossn-light');$('.ossn-halt').show();$('.ossn-viewer').html('<table class="ossn-container"><tr><td class="image-block" style="text-align: center;width:100%;"><div class="ossn-viewer-loding">Loading...</div></td></tr></table>');$('.ossn-viewer').show();},callback:function(callback){$('.ossn-viewer').html(callback).show();},});};Ossn.ViewerClose=function($url){$('.ossn-halt').addClass('ossn-light');$('.ossn-halt').hide();$('.ossn-viewer').html('');$('.ossn-viewer').hide();};Ossn.trigger_message=function($message,$type){$type=$type||'success';if($type=='error'){$type='danger';}
if($message==''){return false;}
$html="<div class='alert alert-dismissible alert-"+$type+"'><button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>"+$message+"</div>";$('.ossn-system-messages').find('.ossn-system-messages-inner').append($html);if($('.ossn-system-messages').find('.ossn-system-messages-inner').is(":not(:visible)")){$('.ossn-system-messages').find('.ossn-system-messages-inner').slideDown('slow');}
setTimeout(function(){$('.ossn-system-messages').find('.ossn-system-messages-inner').empty().hide()},10000);};Ossn.Drag=function(){const default_cover_width=1040;const default_cover_height=200;var image_width=document.querySelector("#draggable").naturalWidth;var image_height=document.querySelector("#draggable").naturalHeight;var cover_width=$("#container").width();var cover_height=$("#container").height();var drag_width=0;var drag_height=0;if(image_width>cover_width&&image_width+cover_width>default_cover_width*2){drag_width=image_width-default_cover_width;}
if(image_height>cover_height&&image_height+cover_height>default_cover_height*2){drag_height=image_height-default_cover_height;}
$.globalVars={originalTop:0,originalLeft:0,maxHeight:drag_height,maxWidth:drag_width};$("#draggable").draggable({start:function(event,ui){if(ui.position!=undefined){$.globalVars.originalTop=ui.position.top;$.globalVars.originalLeft=ui.position.left;}},drag:function(event,ui){var newTop=ui.position.top;var newLeft=ui.position.left;if(ui.position.top<0&&ui.position.top*-1>$.globalVars.maxHeight){newTop=$.globalVars.maxHeight*-1;}
if(ui.position.top>0){newTop=0;}
if(ui.position.left<0&&ui.position.left*-1>$.globalVars.maxWidth){newLeft=$.globalVars.maxWidth*-1;}
if(ui.position.left>0){newLeft=0;}
ui.position.top=newTop;ui.position.left=newLeft;}});};Ossn.MessageDone=function($message){return"<div class='ossn-message-done'>"+$message+"</div>";};Ossn.register_callback('ossn','init','ossn_startup_functions_compatibility');Ossn.register_callback('ossn','init','ossn_image_url_cache');Ossn.register_callback('ossn','init','ossn_makesure_confirmation');Ossn.register_callback('ossn','init','ossn_system_messages');Ossn.register_callback('ossn','init','ossn_user_signup_form');Ossn.register_callback('ossn','init','ossn_topbar_dropdown');function ossn_user_signup_form(){Ossn.ajaxRequest({url:Ossn.site_url+"action/user/register",form:'#ossn-home-signup',beforeSend:function(request){var failedValidate=false;$('#ossn-submit-button').show();$('#ossn-home-signup .ossn-loading').addClass("ossn-hidden");$('#ossn-home-signup').find('#ossn-signup-errors').hide();$('#ossn-home-signup input').filter(function(){$(this).closest('span').removeClass('ossn-required');if(this.type=='radio'&&!$(this).hasClass('ossn-field-not-required')){if(!$("input[name='gender']:checked").val()){$(this).closest('span').addClass('ossn-required');failedValidate=true;}}
if(this.value==""&&!$(this).hasClass('ossn-field-not-required')){$(this).addClass('ossn-red-borders');failedValidate=true;request.abort();return false;}});if(failedValidate==false){$('#ossn-submit-button').hide();$('#ossn-home-signup .ossn-loading').removeClass("ossn-hidden");}},callback:function(callback){if(callback['dataerr']){$('#ossn-home-signup').find('#ossn-signup-errors').html(callback['dataerr']).fadeIn();$('#ossn-submit-button').show();$('#ossn-home-signup .ossn-loading').addClass("ossn-hidden");}else if(callback['success']==1){$('#ossn-home-signup').html(Ossn.MessageDone(callback['datasuccess']));}else{$('#ossn-home-signup .ossn-loading').addClass("ossn-hidden");$('#ossn-submit-button').attr('type','submit')
$('#ossn-submit-button').attr('style','opacity:1;');}}});}
function ossn_system_messages(){$(document).ready(function(){if($('.ossn-system-messages').find('button').length){$('.ossn-system-messages').find('.ossn-system-messages-inner').show();setTimeout(function(){$('.ossn-system-messages').find('.ossn-system-messages-inner').hide().empty();},10000);}
$('body').on('click','.ossn-system-messages .close',function(){$('.ossn-system-messages').find('.ossn-system-messages-inner').hide().empty();});});}
function ossn_topbar_dropdown(){$(document).ready(function(){$('.ossn-topbar-dropdown-menu-button').on('click',function(){if($('.ossn-topbar-dropdown-menu-content').is(":not(:visible)")){$('.ossn-topbar-dropdown-menu-content').show();}else{$('.ossn-topbar-dropdown-menu-content').hide();}});});}
function ossn_makesure_confirmation(){$(document).ready(function(){$('body').on('click','.ossn-make-sure',function(e){e.preventDefault();var msg='ossn:exception:make:sure';if(typeof $(this).data('ossn-msg')!=="undefined"){msg=$(this).data('ossn-msg');}
var del=confirm(Ossn.Print(msg));if(del==true){var actionurl=$(this).attr('href');window.location=actionurl;}});});}
function ossn_image_url_cache($callback,$type,$params){$(document).ready(function(){if(Ossn.Config.cache.ossn_cache==1){$('img').each(function(){var data=$(this).attr('src');$site_url=Ossn.ParseUrl(Ossn.site_url);var parts=Ossn.ParseUrl(data),args={},base='';if(parts['host']==$site_url['host']){if(parts['host']===undefined){if(data.indexOf('?')===0){base='?';args=Ossn.ParseStr(parts['query']);}}else{if(parts['query']!==undefined){args=Ossn.ParseStr(parts['query']);}
var split=data.split('?');base=split[0]+'?';}
if(!args['ossn_cache']){args["ossn_cache"]=Ossn.Config.cache.last_cache;$(this).attr('src',base+jQuery.param(args));}}});}});}
function ossn_startup_functions_compatibility($callback,$type,$params){for(var i=0;i<=Ossn.Startups.length;i++){if(typeof Ossn.Startups[i]!=="undefined"){Ossn.Startups[i]();}}}
Ossn.Init=function(){Ossn.trigger_callback('ossn','init');};$(document).ready(function(){$('[data-toggle="tooltip"]').tooltip({placement:'left',});$(document).on('click','#sidebar-toggle',function(){var $toggle=$(this).attr('data-toggle');if($toggle==0){$(this).attr('data-toggle',1);if($(document).innerWidth()>=1300&&$('.ossn-page-loading-annimation').is(':visible')){$('.sidebar').addClass('sidebar-open-no-annimation');$('.ossn-page-container').addClass('sidebar-open-page-container-no-annimation');}else{$('.sidebar').addClass('sidebar-open');$('.ossn-page-container').addClass('sidebar-open-page-container');}
$('.topbar .right-side').addClass('right-side-space');$('.topbar .right-side').addClass('sidebar-hide-contents-xs');$('.ossn-inner-page').addClass('sidebar-hide-contents-xs');}
if($toggle==1){$(this).attr('data-toggle',0);$('.sidebar').removeClass('sidebar-open');$('.sidebar').removeClass('sidebar-open-no-annimation');$('.ossn-page-container').removeClass('sidebar-open-page-container');$('.ossn-page-container').removeClass('sidebar-open-page-container-no-annimation');$('.topbar .right-side').removeClass('right-side-space');$('.topbar .right-side').removeClass('sidebar-hide-contents-xs');$('.ossn-inner-page').removeClass('sidebar-hide-contents-xs');$('.topbar .right-side').addClass('right-side-nospace');$('.sidebar').addClass('sidebar-close');$('.ossn-page-container').addClass('sidebar-close-page-container');}
var document_height=$(document).height();$(".sidebar").height(document_height);});var $chatsidebar=$('.ossn-chat-windows-long .inner');if($chatsidebar.length){$chatsidebar.css('height',$(window).height()-45);}
$(document).scroll(function(){$document_height=$(document).height();$(".sidebar").height($document_height);if($chatsidebar.length){if($(document).scrollTop()>=50){$chatsidebar.addClass('ossnchat-scroll-top');$chatsidebar.css('height',$(window).height());}else if($(document).scrollTop()==0){$chatsidebar.removeClass('ossnchat-scroll-top');$chatsidebar.css('height',$(window).height()-45);}}});if($(document).innerWidth()>=1300){$('#sidebar-toggle').click();}});$(document).ready(function(){$(".ossn-page-loading-annimation").fadeOut("fast");});Ossn.RegisterStartupFunction(function(){$(document).ready(function(){$signup="<div class=\"gdpr\">\n    <p>\n        <input type=\"checkbox\" name=\"gdpr_agree\"> I confirm to agree with your website <a target=\"_blank\" href=\"https:\/\/gosocial.x10.bz\/site\/terms\">Terms and Conditions<\/a> and <a target=\"_blank\" href=\"https:\/\/gosocial.x10.bz\/site\/privacy\">Privacy Policy<\/a> \n    <\/p>\n<\/div>";$($signup).insertBefore('#ossn-home-signup .ossn-loading');$('#ossn-signup-errors').next('p').remove();});});var PasswordValidation=new Array();Array.prototype.remove=function(){var what,a=arguments,L=a.length,ax;while(L&&this.length){what=a[--L];while((ax=this.indexOf(what))!==-1){this.splice(ax,1);}}
return this;};this["JST"]=this["JST"]||{};this["JST"]["input_wrapper"]=function(obj){obj||(obj={});var __t,__p='',__e=_.escape;with(obj){__p+='<div class="jq-password-validator">\n';}
return __p};this["JST"]["length"]=function(obj){obj||(obj={});var __t,__p='',__e=_.escape;with(obj){__p+='<div class="jq-password-validator__rule is-valid length">\n\t'+Ossn.Print('passwordvalidation:atleast',[((__t=(length))==null?'':__t)])+'\n</div>\n';}
return __p};this["JST"]["popover"]=function(obj){obj||(obj={});var __t,__p='',__e=_.escape;with(obj){__p+='<div class="jq-password-validator__popover">\n\t<header>'+Ossn.Print('passwordvalidation:passwordmustbe')+'</header>\n</div>\n';}
return __p};this["JST"]["row"]=function(obj){obj||(obj={});var __t,__p='',__e=_.escape;with(obj){__p+='<div class="jq-password-validator__rule '+
((__t=(ruleName))==null?'':__t)+'">\n\t<svg xmlns="http://www.w3.org/2000/svg" class="jq-password-validator__checkmark" viewBox="0 0 8 8">\n\t  <path d="M6.41 0l-.69.72-2.78 2.78-.81-.78-.72-.72-1.41 1.41.72.72 1.5 1.5.69.72.72-.72 3.5-3.5.72-.72-1.44-1.41z" transform="translate(0 1)" />\n\t</svg>\n\t'+
((__t=(preface))==null?'':__t)+'\n\t<em>'+
((__t=(message))==null?'':__t)+'</em>\n</div>\n';}
return __p};;(function($,window,document,undefined){"use strict";var pluginName="passwordValidator",defaults={length:12,require:["length","lower","upper","digit"]};function Plugin(element,options){this.element=element;this.settings=$.extend({},defaults,options);this._defaults=defaults;this._name=pluginName;this.init();}
var validators={upper:{validate:function(password){if(password.match(/[A-Z]/)!=null){PasswordValidation.remove('upper');return true;}else{if(PasswordValidation.indexOf('upper')==-1){PasswordValidation.push('upper');}
return false;}},message:Ossn.Print('passwordvalidation:capitalletter')},lower:{validate:function(password){if(password.match(/[a-z]/)!=null){PasswordValidation.remove('lower');return true;}else{if(PasswordValidation.indexOf('lower')==-1){PasswordValidation.push('lower');}
return false;}},message:Ossn.Print('passwordvalidation:lowerletter')},digit:{validate:function(password){if(password.match(/\d/)!=null){PasswordValidation.remove('digit');return true;}else{if(PasswordValidation.indexOf('digit')==-1){PasswordValidation.push('digit');}
return false;}},message:Ossn.Print('passwordvalidation:number')},length:{validate:function(password,settings){if(password.length>=settings.length){PasswordValidation.remove('length');return true;}
if(PasswordValidation.indexOf('length')==-1){PasswordValidation.push('length');}
return false;},message:function(settings){return Ossn.Print('passwordvalidation:atleast',[settings.length]);},preface:"",}};$.extend(Plugin.prototype,{init:function(){this.wrapInput(this.element);this.inputWrapper.append(this.buildUi());this.bindBehavior();},wrapInput:function(input){$(input).wrap(JST.input_wrapper());this.inputWrapper=$(".jq-password-validator");return this.inputWrapper;},buildUi:function(){var ui=$(JST.popover());var _this=this;_.each(this.settings.require,function(requirement){var message;if(validators[requirement].message instanceof Function){message=validators[requirement].message(_this.settings);}else{message=validators[requirement].message;}
var preface=validators[requirement].preface;var ruleMarkup=JST.row({ruleName:requirement,message:message,preface:preface});ui.append($(ruleMarkup));});this.ui=ui;ui.hide();return ui;},bindBehavior:function(){var _this=this;$(this.element).on("focus",function(){_this.validate();_this.showUi();});$(this.element).on("blur",function(){_this.hideUi();});$(this.element).on("keyup",function(){_this.validate();});},showUi:function(){this.ui.show();$(this.element).parent().removeClass("is-hidden");$(this.element).parent().addClass("is-visible");},hideUi:function(){this.ui.hide();$(this.element).parent().removeClass("is-visible");$(this.element).parent().addClass("is-hidden");},validate:function(){var currentPassword=$(this.element).val();var _this=this;_.each(this.settings.require,function(requirement){if(validators[requirement].validate(currentPassword,_this.settings)){_this.markRuleValid(requirement);}else{_this.markRuleInvalid(requirement);}});},markRuleValid:function(ruleName){var row=this.ui.find("."+ruleName);row.addClass("is-valid");row.removeClass("is-invalid");},markRuleInvalid:function(ruleName){var row=this.ui.find("."+ruleName);row.removeClass("is-valid");row.addClass("is-invalid");}});$.fn[pluginName]=function(options){return this.each(function(){if(!$.data(this,"plugin_"+pluginName)){$.data(this,"plugin_"+pluginName,new Plugin(this,options));}});};})(jQuery,window,document);Ossn.RegisterStartupFunction(function(){$(document).ready(function(){PasswordValidation.push('length');$('#ossn-home-signup input[name="password"]').passwordValidator({require:['length','lower','upper','digit'],length:8});});});Ossn.RegisterStartupFunction(function(){$(document).ready(function(){$('body').on('click','.menubuilder-icon-select',function(){$('.menu-builder-icons-selected').removeClass('menu-builder-icons-selected');if(!$(this).hasClass('menu-builder-icons-selected')){$(this).addClass('menu-builder-icons-selected');$('input[name="icon_name"').val($(this).attr('data-icon'));$('input[name="icon_unicode"').val($(this).attr('data-key'));}});$('body').on('click','#menu-builder-next',function(){$('.menubuilder-main-form').addClass("hidden");$('.menu-builder-icons').removeClass('hidden');});$('body').on('change','#menu-select-type',function(){$type=$(this).val();Ossn.PostRequest({url:Ossn.site_url+'menubuilder/submenu?type='+$type,beforeSend:function(request){$('.menu-select-sub').html('<div class="ossn-loading-menubuilder"></div>');},callback:function(callback){if(callback){$('.menu-select-sub').html(callback);}}});});$replaceIcons=function($element){$val=$(this).text();$icon=$(this).attr('data-menubuilder-icon');$text=$val.charAt(0).toUpperCase()+$val.slice(1);$(this).html('<i class="'+$icon+'"></i>'+$text);};$('.menubuilder-item-topbar-admin').each($replaceIcons);$('.menubuilder-item-admin-sidemenu').each($replaceIcons);$('[class*=menu-topbar-dropdown-menubuilder]').each($replaceIcons);$('.menubuilder-item-footer').each($replaceIcons);});});Ossn.register_callback('ossn','init','MarkNotification_js_init');function MarkNotification_js_init(){$(document).ready(function(){$('body').delegate('.apop-notif-read','click',function(){var $guid=$(this).attr('data-guid');});$('body').delegate('.apop-notif-delete','click',function(){var $guid=$(this).attr('data-guid');});});}
function mnInstant(type,guid){let xhr=new XMLHttpRequest();if(type==1){let url=Ossn.site_url+"action/mark/delete?guid="+guid.toString();url=Ossn.AddTokenToUrl(url);xhr.open('PUT',url,true);xhr.setRequestHeader("Content-Type","application/json")
xhr.send(null);Ossn.trigger_message('Notification has been deleted. You may have to refresh to see it removed.','success');Ossn.NotificationsCheck();}
if(type==2){let url=Ossn.site_url+"action/mark/read?guid="+guid.toString();url=Ossn.AddTokenToUrl(url);xhr.open('PUT',url,true);xhr.setRequestHeader("Content-Type","application/json")
xhr.send(null);Ossn.trigger_message('Notification has been Marked Read. You may have to refresh to see it changed.','success');Ossn.NotificationsCheck();}}
$(document).ready(function(){if($('#ossn-home-signup').length){$('#country-selector').parent().find('label').hide();$('#country-selector').prepend("<option value=\"\" selected hidden>"+Ossn.Print('com:country:selector:label')+"</option>");$.ajax({url:'https://ipinfo.io',type:'GET',dataType:'json',async:false,success:function(json){$('#country-selector option[value='+json.country+']').prop('selected','selected').change();},error:function(err){console.log("Request failed, error= "+err);}});}});$(document).ready(function(){$('#open_create').click(function(){var timezone_offset_minutes=new Date().getTimezoneOffset();timezone_offset_minutes=timezone_offset_minutes==0?0:-timezone_offset_minutes;Ossn.PostRequest({url:Ossn.site_url+"action/client/timezone",params:'client_time='+timezone_offset_minutes,callback:function(return_data){var client_timezone=return_data['data'];var select=$('.timezone-dropdown');var option=select.find("option:contains("+client_timezone+")");var optionTop=option.offset().top
var selectTop=select.offset().top;select.scrollTop(select.scrollTop()+(optionTop-selectTop));option.prop('selected',true)}});});});