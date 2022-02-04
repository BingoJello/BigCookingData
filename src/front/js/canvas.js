/*
 jCanvas v16.07.03
 Copyright 2016 Caleb Evans
 Released under the MIT license
*/
(function(f,U,F){"object"===typeof module&&"object"===typeof module.exports?module.exports=function(f,U){return F(f,U)}:F(f,U)})("undefined"!==typeof window?window.jQuery:{},"undefined"!==typeof window?window:this,function(f,U){function F(d){for(var c in d)d.hasOwnProperty(c)&&(this[c]=d[c]);return this}function na(){aa(this,na.baseDefaults)}function ja(d){return"string"===ba(d)}function K(d){return d&&d.getContext?d.getContext("2d"):h}function ka(d){var c,a,b;for(c in d)d.hasOwnProperty(c)&&(b=d[c],
a=ba(b),"string"!==a||isNaN(oa(b))||isNaN(Y(b))||"text"===c||(d[c]=Y(b)));void 0!==d.text&&(d.text=String(d.text))}function la(d){d=aa({},d);d.masks=d.masks.slice(0);return d}function fa(d,c){var a;d.save();a=la(c.transforms);c.savedTransforms.push(a)}function xa(d,c,a,b){a[b]&&(da(a[b])?c[b]=a[b].call(d,a):c[b]=a[b])}function S(d,c,a){xa(d,c,a,"fillStyle");xa(d,c,a,"strokeStyle");c.lineWidth=a.strokeWidth;a.rounded?c.lineCap=c.lineJoin="round":(c.lineCap=a.strokeCap,c.lineJoin=a.strokeJoin,c.miterLimit=
a.miterLimit);a.strokeDash||(a.strokeDash=[]);c.setLineDash&&c.setLineDash(a.strokeDash);c.webkitLineDash=a.strokeDash;c.lineDashOffset=c.webkitLineDashOffset=c.mozDashOffset=a.strokeDashOffset;c.shadowOffsetX=a.shadowX;c.shadowOffsetY=a.shadowY;c.shadowBlur=a.shadowBlur;c.shadowColor=a.shadowColor;c.globalAlpha=a.opacity;c.globalCompositeOperation=a.compositing;a.imageSmoothing&&(c.imageSmoothingEnabled=c.mozImageSmoothingEnabled=a.imageSmoothingEnabled)}function ya(d,c,a){a.mask&&(a.autosave&&fa(d,
c),d.clip(),c.transforms.masks.push(a._args))}function W(d,c,a){a.closed&&c.closePath();a.shadowStroke&&0!==a.strokeWidth?(c.stroke(),c.fill(),c.shadowColor="transparent",c.shadowBlur=0,c.stroke()):(c.fill(),"transparent"!==a.fillStyle&&(c.shadowColor="transparent"),0!==a.strokeWidth&&c.stroke());a.closed||c.closePath();a._transformed&&c.restore();a.mask&&(d=L(d),ya(c,d,a))}function R(d,c,a,b,g){a._toRad=a.inDegrees?D/180:1;a._transformed=v;c.save();a.fromCenter||a._centered||b===q||(g===q&&(g=b),
a.x+=b/2,a.y+=g/2,a._centered=v);a.rotate&&za(c,a,h);1===a.scale&&1===a.scaleX&&1===a.scaleY||Aa(c,a,h);(a.translate||a.translateX||a.translateY)&&Ba(c,a,h)}function L(d){var c=ca.dataCache,a;c._canvas===d&&c._data?a=c._data:(a=f.data(d,"jCanvas"),a||(a={canvas:d,layers:[],layer:{names:{},groups:{}},eventHooks:{},intersecting:[],lastIntersected:h,cursor:f(d).css("cursor"),drag:{layer:h,dragging:C},event:{type:h,x:h,y:h},events:{},transforms:la(pa),savedTransforms:[],animating:C,animated:h,pixelRatio:1,
scaled:C},f.data(d,"jCanvas",a)),c._canvas=d,c._data=a);return a}function Ca(d,c,a){for(var b in Z.events)Z.events.hasOwnProperty(b)&&(a[b]||a.cursors&&a.cursors[b])&&Da(d,c,a,b);c.events.mouseout||(d.bind("mouseout.jCanvas",function(){var a=c.drag.layer,b;a&&(c.drag={},P(d,c,a,"dragcancel"));for(b=0;b<c.layers.length;b+=1)a=c.layers[b],a._hovered&&d.triggerLayerEvent(c.layers[b],"mouseout");d.drawLayers()}),c.events.mouseout=v)}function Da(d,c,a,b){Z.events[b](d,c);a._event=v}function Ea(d,c,a){var b,
g,e;if(a.draggable||a.cursors){b=["mousedown","mousemove","mouseup"];for(e=0;e<b.length;e+=1)g=b[e],Da(d,c,a,g);a._event=v}}function qa(d,c,a,b){d=c.layer.names;b?b.name!==q&&ja(a.name)&&a.name!==b.name&&delete d[a.name]:b=a;ja(b.name)&&(d[b.name]=a)}function ra(d,c,a,b){d=c.layer.groups;var g,e,k,f;if(!b)b=a;else if(b.groups!==q&&a.groups!==h)for(e=0;e<a.groups.length;e+=1)if(g=a.groups[e],c=d[g]){for(f=0;f<c.length;f+=1)if(c[f]===a){k=f;c.splice(f,1);break}0===c.length&&delete d[g]}if(b.groups!==
q&&b.groups!==h)for(e=0;e<b.groups.length;e+=1)g=b.groups[e],c=d[g],c||(c=d[g]=[],c.name=g),k===q&&(k=c.length),c.splice(k,0,a)}function sa(d,c,a,b,g){b[a]&&c._running&&!c._running[a]&&(c._running[a]=v,b[a].call(d[0],c,g),c._running[a]=C)}function P(d,c,a,b,g){if(!(a.disableEvents||a.intangible&&-1!==f.inArray(b,Va))){if("mouseout"!==b){var e;a.cursors&&(e=a.cursors[b]);-1!==f.inArray(e,V.cursors)&&(e=V.prefix+e);e&&d.css({cursor:e})}sa(d,a,b,a,g);sa(d,a,b,c.eventHooks,g);sa(d,a,b,Z.eventHooks,g)}}
function O(d,c,a,b){var g,e=c._layer?a:c;c._args=a;if(c.draggable||c.dragGroups)c.layer=v,c.draggable=v;c._method||(c._method=b?b:c.method?f.fn[c.method]:c.type?f.fn[X.drawings[c.type]]:function(){});if(c.layer&&!c._layer){if(a=f(d),b=L(d),g=b.layers,e.name===h||ja(e.name)&&b.layer.names[e.name]===q)ka(c),e=new F(c),e.canvas=d,e.layer=v,e._layer=v,e._running={},e.data=e.data!==h?aa({},e.data):{},e.groups=e.groups!==h?e.groups.slice(0):[],qa(a,b,e),ra(a,b,e),Ca(a,b,e),Ea(a,b,e),c._event=e._event,e._method===
f.fn.drawText&&a.measureText(e),e.index===h&&(e.index=g.length),g.splice(e.index,0,e),c._args=e,P(a,b,e,"add")}else c.layer||ka(c);return e}function Fa(d,c){var a,b;for(b=0;b<V.props.length;b+=1)a=V.props[b],d[a]!==q&&(d["_"+a]=d[a],V.propsObj[a]=v,c&&delete d[a])}function Wa(d,c,a){var b,g,e,k;for(b in a)if(a.hasOwnProperty(b)&&(g=a[b],da(g)&&(a[b]=g.call(d,c,b)),"object"===ba(g)&&Ga(g))){for(e in g)g.hasOwnProperty(e)&&(k=g[e],c[b]!==q&&(c[b+"."+e]=c[b][e],a[b+"."+e]=k));delete a[b]}return a}function Ha(d){var c,
a,b=[],g=1;"transparent"===d?d="rgba(0, 0, 0, 0)":d.match(/^([a-z]+|#[0-9a-f]+)$/gi)&&(a=Ia.head,c=a.style.color,a.style.color=d,d=f.css(a,"color"),a.style.color=c);d.match(/^rgb/gi)&&(b=d.match(/(\d+(\.\d+)?)/gi),d.match(/%/gi)&&(g=2.55),b[0]*=g,b[1]*=g,b[2]*=g,b[3]=b[3]!==q?Y(b[3]):1);return b}function Xa(d){var c=3,a;"array"!==ba(d.start)&&(d.start=Ha(d.start),d.end=Ha(d.end));d.now=[];if(1!==d.start[3]||1!==d.end[3])c=4;for(a=0;a<c;a+=1)d.now[a]=d.start[a]+(d.end[a]-d.start[a])*d.pos,3>a&&(d.now[a]=
Ya(d.now[a]));1!==d.start[3]||1!==d.end[3]?d.now="rgba( "+d.now.join(",")+" )":(d.now.slice(0,3),d.now="rgb( "+d.now.join(",")+" )");d.elem.nodeName?d.elem.style[d.prop]=d.now:d.elem[d.prop]=d.now}function Za(d){X.touchEvents[d]&&(d=X.touchEvents[d]);return d}function $a(d){Z.events[d]=function(c,a){function b(a){k.x=a.offsetX;k.y=a.offsetY;k.type=g;k.event=a;c.drawLayers({resetFire:v});a.preventDefault()}var g,e,k;k=a.event;g="mouseover"===d||"mouseout"===d?"mousemove":d;e=Za(g);a.events[g]||(e!==
g?c.bind(g+".jCanvas "+e+".jCanvas",b):c.bind(g+".jCanvas",b),a.events[g]=v)}}function T(d,c,a){var b,g,e,k;if(a=a._args)d=L(d),b=d.event,b.x!==h&&b.y!==h&&(e=b.x*d.pixelRatio,k=b.y*d.pixelRatio,g=c.isPointInPath(e,k)||c.isPointInStroke&&c.isPointInStroke(e,k)),c=d.transforms,a.eventX=b.x,a.eventY=b.y,a.event=b.event,b=d.transforms.rotate,e=a.eventX,k=a.eventY,0!==b?(a._eventX=e*N(-b)-k*Q(-b),a._eventY=k*N(-b)+e*Q(-b)):(a._eventX=e,a._eventY=k),a._eventX/=c.scaleX,a._eventY/=c.scaleY,g&&d.intersecting.push(a),
a.intersects=!!g}function za(d,c,a){c._toRad=c.inDegrees?D/180:1;d.translate(c.x,c.y);d.rotate(c.rotate*c._toRad);d.translate(-c.x,-c.y);a&&(a.rotate+=c.rotate*c._toRad)}function Aa(d,c,a){1!==c.scale&&(c.scaleX=c.scaleY=c.scale);d.translate(c.x,c.y);d.scale(c.scaleX,c.scaleY);d.translate(-c.x,-c.y);a&&(a.scaleX*=c.scaleX,a.scaleY*=c.scaleY)}function Ba(d,c,a){c.translate&&(c.translateX=c.translateY=c.translate);d.translate(c.translateX,c.translateY);a&&(a.translateX+=c.translateX,a.translateY+=c.translateY)}
function Ja(d){for(;0>d;)d+=2*D;return d}function Ka(d,c,a,b){var g,e,k,f,y,x,A;a===b?A=x=0:(x=a.x,A=a.y);b.inDegrees||360!==b.end||(b.end=2*D);b.start*=a._toRad;b.end*=a._toRad;b.start-=D/2;b.end-=D/2;y=D/180;b.ccw&&(y*=-1);g=b.x+b.radius*N(b.start+y);e=b.y+b.radius*Q(b.start+y);k=b.x+b.radius*N(b.start);f=b.y+b.radius*Q(b.start);ga(d,c,a,b,g,e,k,f);c.arc(b.x+x,b.y+A,b.radius,b.start,b.end,b.ccw);g=b.x+b.radius*N(b.end+y);y=b.y+b.radius*Q(b.end+y);e=b.x+b.radius*N(b.end);k=b.y+b.radius*Q(b.end);
ha(d,c,a,b,e,k,g,y)}function La(d,c,a,b,g,e,k,f){var y,x;b.arrowRadius&&!a.closed&&(x=ab(f-e,k-g),x-=D,d=a.strokeWidth*N(x),y=a.strokeWidth*Q(x),a=k+b.arrowRadius*N(x+b.arrowAngle/2),g=f+b.arrowRadius*Q(x+b.arrowAngle/2),e=k+b.arrowRadius*N(x-b.arrowAngle/2),b=f+b.arrowRadius*Q(x-b.arrowAngle/2),c.moveTo(a-d,g-y),c.lineTo(k-d,f-y),c.lineTo(e-d,b-y),c.moveTo(k-d,f-y),c.lineTo(k+d,f+y),c.moveTo(k,f))}function ga(d,c,a,b,g,e,k,f){b._arrowAngleConverted||(b.arrowAngle*=a._toRad,b._arrowAngleConverted=
v);b.startArrow&&La(d,c,a,b,g,e,k,f)}function ha(d,c,a,b,g,e,k,f){b._arrowAngleConverted||(b.arrowAngle*=a._toRad,b._arrowAngleConverted=v);b.endArrow&&La(d,c,a,b,g,e,k,f)}function Ma(d,c,a,b){var g,e,k;g=2;ga(d,c,a,b,b.x2+a.x,b.y2+a.y,b.x1+a.x,b.y1+a.y);for(b.x1!==q&&b.y1!==q&&c.moveTo(b.x1+a.x,b.y1+a.y);v;)if(e=b["x"+g],k=b["y"+g],e!==q&&k!==q)c.lineTo(e+a.x,k+a.y),g+=1;else break;g-=1;ha(d,c,a,b,b["x"+(g-1)]+a.x,b["y"+(g-1)]+a.y,b["x"+g]+a.x,b["y"+g]+a.y)}function Na(d,c,a,b){var g,e,k,f,y;g=2;
ga(d,c,a,b,b.cx1+a.x,b.cy1+a.y,b.x1+a.x,b.y1+a.y);for(b.x1!==q&&b.y1!==q&&c.moveTo(b.x1+a.x,b.y1+a.y);v;)if(e=b["x"+g],k=b["y"+g],f=b["cx"+(g-1)],y=b["cy"+(g-1)],e!==q&&k!==q&&f!==q&&y!==q)c.quadraticCurveTo(f+a.x,y+a.y,e+a.x,k+a.y),g+=1;else break;g-=1;ha(d,c,a,b,b["cx"+(g-1)]+a.x,b["cy"+(g-1)]+a.y,b["x"+g]+a.x,b["y"+g]+a.y)}function Oa(d,c,a,b){var g,e,k,f,y,x,A,h;g=2;e=1;ga(d,c,a,b,b.cx1+a.x,b.cy1+a.y,b.x1+a.x,b.y1+a.y);for(b.x1!==q&&b.y1!==q&&c.moveTo(b.x1+a.x,b.y1+a.y);v;)if(k=b["x"+g],f=b["y"+
g],y=b["cx"+e],x=b["cy"+e],A=b["cx"+(e+1)],h=b["cy"+(e+1)],k!==q&&f!==q&&y!==q&&x!==q&&A!==q&&h!==q)c.bezierCurveTo(y+a.x,x+a.y,A+a.x,h+a.y,k+a.x,f+a.y),g+=1,e+=2;else break;g-=1;e-=2;ha(d,c,a,b,b["cx"+(e+1)]+a.x,b["cy"+(e+1)]+a.y,b["x"+g]+a.x,b["y"+g]+a.y)}function Pa(d,c,a){c*=d._toRad;c-=D/2;return a*N(c)}function Qa(d,c,a){c*=d._toRad;c-=D/2;return a*Q(c)}function Ra(d,c,a,b){var g,e,k,f,y,h,A;a===b?y=f=0:(f=a.x,y=a.y);g=1;e=f=h=b.x+f;k=y=A=b.y+y;ga(d,c,a,b,e+Pa(a,b.a1,b.l1),k+Qa(a,b.a1,b.l1),
e,k);for(b.x!==q&&b.y!==q&&c.moveTo(e,k);v;)if(e=b["a"+g],k=b["l"+g],e!==q&&k!==q)f=h,y=A,h+=Pa(a,e,k),A+=Qa(a,e,k),c.lineTo(h,A),g+=1;else break;ha(d,c,a,b,f,y,h,A)}function ta(d,c,a){isNaN(oa(a.fontSize))||(a.fontSize+="px");c.font=a.fontStyle+" "+a.fontSize+" "+a.fontFamily}function ua(d,c,a,b){var g,e;g=ca.propCache;if(g.text===a.text&&g.fontStyle===a.fontStyle&&g.fontSize===a.fontSize&&g.fontFamily===a.fontFamily&&g.maxWidth===a.maxWidth&&g.lineHeight===a.lineHeight)a.width=g.width,a.height=
g.height;else{a.width=c.measureText(b[0]).width;for(e=1;e<b.length;e+=1)g=c.measureText(b[e]).width,g>a.width&&(a.width=g);c=d.style.fontSize;d.style.fontSize=a.fontSize;a.height=Y(f.css(d,"fontSize"))*b.length*a.lineHeight;d.style.fontSize=c}}function Sa(d,c){var a=c.maxWidth,b=String(c.text).split("\n"),g=[],e,k,f,h,x;for(f=0;f<b.length;f+=1){h=b[f];x=h.split(" ");e=[];k="";if(1===x.length||d.measureText(h).width<a)e=[h];else{for(h=0;h<x.length;h+=1)d.measureText(k+x[h]).width>a&&(""!==k&&e.push(k),
k=""),k+=x[h],h!==x.length-1&&(k+=" ");e.push(k)}g=g.concat(e.join("\n").replace(/( (\n))|( $)/gi,"$2").split("\n"))}return g}var Ia=U.document,Ta=U.Image,bb=U.getComputedStyle,ea=U.Math,oa=U.Number,Y=U.parseFloat,v=!0,C=!1,h=null,q=void 0,ma,aa=f.extend,ia=f.inArray,ba=function(d){return Object.prototype.toString.call(d).slice(8,-1).toLowerCase()},da=f.isFunction,Ga=f.isPlainObject,D=ea.PI,Ya=ea.round,cb=ea.abs,Q=ea.sin,N=ea.cos,ab=ea.atan2,va=U.Array.prototype.slice,db=f.event.fixOffset,X={},ca=
{dataCache:{},propCache:{},imageCache:{}},pa={rotate:0,scaleX:1,scaleY:1,translateX:0,translateY:0,masks:[]},V={},Va="mousedown mousemove mouseup mouseover mouseout touchstart touchmove touchend".split(" "),Z={events:{},eventHooks:{},future:{}};na.baseDefaults={align:"center",arrowAngle:90,arrowRadius:0,autosave:v,baseline:"middle",bringToFront:C,ccw:C,closed:C,compositing:"source-over",concavity:0,cornerRadius:0,count:1,cropFromCenter:v,crossOrigin:h,cursors:h,disableEvents:C,draggable:C,dragGroups:h,
groups:h,data:h,dx:h,dy:h,end:360,eventX:h,eventY:h,fillStyle:"transparent",fontStyle:"normal",fontSize:"12pt",fontFamily:"sans-serif",fromCenter:v,height:h,imageSmoothing:v,inDegrees:v,intangible:C,index:h,letterSpacing:h,lineHeight:1,layer:C,mask:C,maxWidth:h,miterLimit:10,name:h,opacity:1,r1:h,r2:h,radius:0,repeat:"repeat",respectAlign:C,restrictDragToAxis:null,rotate:0,rounded:C,scale:1,scaleX:1,scaleY:1,shadowBlur:0,shadowColor:"transparent",shadowStroke:C,shadowX:0,shadowY:0,sHeight:h,sides:0,
source:"",spread:0,start:0,strokeCap:"butt",strokeDash:h,strokeDashOffset:0,strokeJoin:"miter",strokeStyle:"transparent",strokeWidth:1,sWidth:h,sx:h,sy:h,text:"",translate:0,translateX:0,translateY:0,type:h,visible:v,width:h,x:0,y:0};ma=new na;F.prototype=ma;Z.extend=function(d){d.name&&(d.props&&aa(ma,d.props),f.fn[d.name]=function a(b){var g,e,k,f;for(e=0;e<this.length;e+=1)if(g=this[e],k=K(g))f=new F(b),O(g,f,b,a),S(g,k,f),d.fn.call(g,k,f);return this},d.type&&(X.drawings[d.type]=d.name));return f.fn[d.name]};
f.fn.getEventHooks=function(){var d;d={};0!==this.length&&(d=this[0],d=L(d),d=d.eventHooks);return d};f.fn.setEventHooks=function(d){var c,a;for(c=0;c<this.length;c+=1)f(this[c]),a=L(this[c]),aa(a.eventHooks,d);return this};f.fn.getLayers=function(d){var c,a,b,g,e=[];if(0!==this.length)if(c=this[0],a=L(c),a=a.layers,da(d))for(g=0;g<a.length;g+=1)b=a[g],d.call(c,b)&&e.push(b);else e=a;return e};f.fn.getLayer=function(d){var c,a,b,g;if(0!==this.length)if(c=this[0],a=L(c),c=a.layers,g=ba(d),d&&d.layer)b=
d;else if("number"===g)0>d&&(d=c.length+d),b=c[d];else if("regexp"===g)for(a=0;a<c.length;a+=1){if(ja(c[a].name)&&c[a].name.match(d)){b=c[a];break}}else b=a.layer.names[d];return b};f.fn.getLayerGroup=function(d){var c,a,b,g=ba(d);if(0!==this.length)if(c=this[0],"array"===g)b=d;else if("regexp"===g)for(a in c=L(c),c=c.layer.groups,c){if(a.match(d)){b=c[a];break}}else c=L(c),b=c.layer.groups[d];return b};f.fn.getLayerIndex=function(d){var c=this.getLayers();d=this.getLayer(d);return ia(d,c)};f.fn.setLayer=
function(d,c){var a,b,g,e,k,h,y;for(b=0;b<this.length;b+=1)if(a=f(this[b]),g=L(this[b]),e=f(this[b]).getLayer(d)){qa(a,g,e,c);ra(a,g,e,c);ka(c);for(k in c)c.hasOwnProperty(k)&&(h=c[k],y=ba(h),"object"===y&&Ga(h)?(e[k]=aa({},h),ka(e[k])):"array"===y?e[k]=h.slice(0):"string"===y?0===h.indexOf("+=")?e[k]+=Y(h.substr(2)):0===h.indexOf("-=")?e[k]-=Y(h.substr(2)):isNaN(h)||isNaN(oa(h))||isNaN(Y(h))||"text"===k?e[k]=h:e[k]=Y(h):e[k]=h);Ca(a,g,e);Ea(a,g,e);f.isEmptyObject(c)===C&&P(a,g,e,"change",c)}return this};
f.fn.setLayers=function(d,c){var a,b,g,e;for(b=0;b<this.length;b+=1)for(a=f(this[b]),g=a.getLayers(c),e=0;e<g.length;e+=1)a.setLayer(g[e],d);return this};f.fn.setLayerGroup=function(d,c){var a,b,g,e;for(b=0;b<this.length;b+=1)if(a=f(this[b]),g=a.getLayerGroup(d))for(e=0;e<g.length;e+=1)a.setLayer(g[e],c);return this};f.fn.moveLayer=function(d,c){var a,b,g,e,k;for(b=0;b<this.length;b+=1)if(a=f(this[b]),g=L(this[b]),e=g.layers,k=a.getLayer(d))k.index=ia(k,e),e.splice(k.index,1),e.splice(c,0,k),0>c&&
(c=e.length+c),k.index=c,P(a,g,k,"move");return this};f.fn.removeLayer=function(d){var c,a,b,g,e;for(a=0;a<this.length;a+=1)if(c=f(this[a]),b=L(this[a]),g=c.getLayers(),e=c.getLayer(d))e.index=ia(e,g),g.splice(e.index,1),delete e._layer,qa(c,b,e,{name:h}),ra(c,b,e,{groups:h}),P(c,b,e,"remove");return this};f.fn.removeLayers=function(d){var c,a,b,g,e,k;for(a=0;a<this.length;a+=1){c=f(this[a]);b=L(this[a]);g=c.getLayers(d);for(k=0;k<g.length;k+=1)e=g[k],c.removeLayer(e),k-=1;b.layer.names={};b.layer.groups=
{}}return this};f.fn.removeLayerGroup=function(d){var c,a,b,g;if(d!==q)for(a=0;a<this.length;a+=1)if(c=f(this[a]),L(this[a]),c.getLayers(),b=c.getLayerGroup(d))for(b=b.slice(0),g=0;g<b.length;g+=1)c.removeLayer(b[g]);return this};f.fn.addLayerToGroup=function(d,c){var a,b,g,e=[c];for(b=0;b<this.length;b+=1)a=f(this[b]),g=a.getLayer(d),g.groups&&(e=g.groups.slice(0),-1===ia(c,g.groups)&&e.push(c)),a.setLayer(g,{groups:e});return this};f.fn.removeLayerFromGroup=function(d,c){var a,b,g,e=[],k;for(b=
0;b<this.length;b+=1)a=f(this[b]),g=a.getLayer(d),g.groups&&(k=ia(c,g.groups),-1!==k&&(e=g.groups.slice(0),e.splice(k,1),a.setLayer(g,{groups:e})));return this};V.cursors=["grab","grabbing","zoom-in","zoom-out"];V.prefix=function(){var d=bb(Ia.documentElement,"");return"-"+(va.call(d).join("").match(/-(moz|webkit|ms)-/)||""===d.OLink&&["","o"])[1]+"-"}();f.fn.triggerLayerEvent=function(d,c){var a,b,g;for(b=0;b<this.length;b+=1)a=f(this[b]),g=L(this[b]),(d=a.getLayer(d))&&P(a,g,d,c);return this};f.fn.drawLayer=
function(d){var c,a,b;for(c=0;c<this.length;c+=1)b=f(this[c]),(a=K(this[c]))&&(a=b.getLayer(d))&&a.visible&&a._method&&(a._next=h,a._method.call(b,a));return this};f.fn.drawLayers=function(d){var c,a,b=d||{},g,e,k,q,y,x,A,J;(q=b.index)||(q=0);for(c=0;c<this.length;c+=1)if(d=f(this[c]),a=K(this[c])){y=L(this[c]);b.clear!==C&&d.clearCanvas();a=y.layers;for(k=q;k<a.length;k+=1)if(g=a[k],g.index=k,b.resetFire&&(g._fired=C),x=d,A=g,e=k+1,A&&A.visible&&A._method&&(A._next=e?e:h,A._method.call(x,A)),g._masks=
y.transforms.masks.slice(0),g._method===f.fn.drawImage&&g.visible){J=!0;break}if(J)break;g=y;var z=e=A=x=void 0;x=h;for(A=g.intersecting.length-1;0<=A;A-=1)if(x=g.intersecting[A],x._masks){for(z=x._masks.length-1;0<=z;z-=1)if(e=x._masks[z],!e.intersects){x.intersects=C;break}if(x.intersects&&!x.intangible)break}x&&x.intangible&&(x=h);g=x;x=y.event;A=x.type;if(y.drag.layer){e=d;var z=y,G=A,u=void 0,p=void 0,m=void 0,B=m=void 0,E=void 0,m=u=u=m=void 0,m=z.drag,B=(p=m.layer)&&p.dragGroups||[],u=z.layers;
if("mousemove"===G||"touchmove"===G){if(m.dragging||(m.dragging=v,p.dragging=v,p.bringToFront&&(u.splice(p.index,1),p.index=u.push(p)),p._startX=p.x,p._startY=p.y,p._endX=p._eventX,p._endY=p._eventY,P(e,z,p,"dragstart")),m.dragging)for(u=p._eventX-(p._endX-p._startX),m=p._eventY-(p._endY-p._startY),p.dx=u-p.x,p.dy=m-p.y,"y"!==p.restrictDragToAxis&&(p.x=u),"x"!==p.restrictDragToAxis&&(p.y=m),P(e,z,p,"drag"),u=0;u<B.length;u+=1)if(m=B[u],E=z.layer.groups[m],p.groups&&E)for(m=0;m<E.length;m+=1)E[m]!==
p&&("y"!==p.restrictDragToAxis&&"y"!==E[m].restrictDragToAxis&&(E[m].x+=p.dx),"x"!==p.restrictDragToAxis&&"x"!==E[m].restrictDragToAxis&&(E[m].y+=p.dy))}else if("mouseup"===G||"touchend"===G)m.dragging&&(p.dragging=C,m.dragging=C,P(e,z,p,"dragstop")),z.drag={}}e=y.lastIntersected;e===h||g===e||!e._hovered||e._fired||y.drag.dragging||(y.lastIntersected=h,e._fired=v,e._hovered=C,P(d,y,e,"mouseout"),d.css({cursor:y.cursor}));g&&(g[A]||X.mouseEvents[A]&&(A=X.mouseEvents[A]),g._event&&g.intersects&&(y.lastIntersected=
g,!(g.mouseover||g.mouseout||g.cursors)||y.drag.dragging||g._hovered||g._fired||(g._fired=v,g._hovered=v,P(d,y,g,"mouseover")),g._fired||(g._fired=v,x.type=h,P(d,y,g,A)),!g.draggable||g.disableEvents||"mousedown"!==A&&"touchstart"!==A||(y.drag.layer=g)));g!==h||y.drag.dragging||d.css({cursor:y.cursor});k===a.length&&(y.intersecting.length=0,y.transforms=la(pa),y.savedTransforms.length=0)}return this};f.fn.addLayer=function(d){var c,a;for(c=0;c<this.length;c+=1)if(a=K(this[c]))a=new F(d),a.layer=v,
O(this[c],a,d);return this};V.props=["width","height","opacity","lineHeight"];V.propsObj={};f.fn.animateLayer=function(){function d(a,b,c){return function(){var d,g;for(g=0;g<V.props.length;g+=1)d=V.props[g],c[d]=c["_"+d];for(var k in c)c.hasOwnProperty(k)&&-1!==k.indexOf(".")&&delete c[k];b.animating&&b.animated!==c||a.drawLayers();c._animating=C;b.animating=C;b.animated=h;e[4]&&e[4].call(a[0],c);P(a,b,c,"animateend")}}function c(a,b,c){return function(d,g){var k,f,h=!1;"_"===g.prop[0]&&(h=!0,g.prop=
g.prop.replace("_",""),c[g.prop]=c["_"+g.prop]);-1!==g.prop.indexOf(".")&&(k=g.prop.split("."),f=k[0],k=k[1],c[f]&&(c[f][k]=g.now));c._pos!==g.pos&&(c._pos=g.pos,c._animating||b.animating||(c._animating=v,b.animating=v,b.animated=c),b.animating&&b.animated!==c||a.drawLayers());e[5]&&e[5].call(a[0],d,g,c);P(a,b,c,"animate",g);h&&(g.prop="_"+g.prop)}}var a,b,g,e=va.call(arguments,0),k,F;"object"===ba(e[2])?(e.splice(2,0,e[2].duration||h),e.splice(3,0,e[3].easing||h),e.splice(4,0,e[4].complete||h),e.splice(5,
0,e[5].step||h)):(e[2]===q?(e.splice(2,0,h),e.splice(3,0,h),e.splice(4,0,h)):da(e[2])&&(e.splice(2,0,h),e.splice(3,0,h)),e[3]===q?(e[3]=h,e.splice(4,0,h)):da(e[3])&&e.splice(3,0,h));for(b=0;b<this.length;b+=1)if(a=f(this[b]),g=K(this[b]))g=L(this[b]),(k=a.getLayer(e[0]))&&k._method!==f.fn.draw&&(F=aa({},e[1]),F=Wa(this[b],k,F),Fa(F,v),Fa(k),k.style=V.propsObj,f(k).animate(F,{duration:e[2],easing:f.easing[e[3]]?e[3]:h,complete:d(a,g,k),step:c(a,g,k)}),P(a,g,k,"animatestart"));return this};f.fn.animateLayerGroup=
function(d){var c,a,b=va.call(arguments,0),g,e;for(a=0;a<this.length;a+=1)if(c=f(this[a]),g=c.getLayerGroup(d))for(e=0;e<g.length;e+=1)b[0]=g[e],c.animateLayer.apply(c,b);return this};f.fn.delayLayer=function(d,c){var a,b,g,e;c=c||0;for(b=0;b<this.length;b+=1)if(a=f(this[b]),g=L(this[b]),e=a.getLayer(d))f(e).delay(c),P(a,g,e,"delay");return this};f.fn.delayLayerGroup=function(d,c){var a,b,g,e,k;c=c||0;for(b=0;b<this.length;b+=1)if(a=f(this[b]),g=a.getLayerGroup(d))for(k=0;k<g.length;k+=1)e=g[k],a.delayLayer(e,
c);return this};f.fn.stopLayer=function(d,c){var a,b,g,e;for(b=0;b<this.length;b+=1)if(a=f(this[b]),g=L(this[b]),e=a.getLayer(d))f(e).stop(c),P(a,g,e,"stop");return this};f.fn.stopLayerGroup=function(d,c){var a,b,g,e,k;for(b=0;b<this.length;b+=1)if(a=f(this[b]),g=a.getLayerGroup(d))for(k=0;k<g.length;k+=1)e=g[k],a.stopLayer(e,c);return this};(function(d){var c;for(c=0;c<d.length;c+=1)f.fx.step[d[c]]=Xa})("color backgroundColor borderColor borderTopColor borderRightColor borderBottomColor borderLeftColor fillStyle outlineColor strokeStyle shadowColor".split(" "));
X.touchEvents={mousedown:"touchstart",mouseup:"touchend",mousemove:"touchmove"};X.mouseEvents={touchstart:"mousedown",touchend:"mouseup",touchmove:"mousemove"};(function(d){var c;for(c=0;c<d.length;c+=1)$a(d[c])})("click dblclick mousedown mouseup mousemove mouseover mouseout touchstart touchmove touchend contextmenu".split(" "));f.event.fixOffset=function(d){var c,a;d=db.call(f.event,d);if(c=d.originalEvent)if(a=c.changedTouches,d.pageX!==q&&d.offsetX===q){if(c=f(d.currentTarget).offset())d.offsetX=
d.pageX-c.left,d.offsetY=d.pageY-c.top}else a&&(c=f(d.currentTarget).offset())&&(d.offsetX=a[0].pageX-c.left,d.offsetY=a[0].pageY-c.top);return d};X.drawings={arc:"drawArc",bezier:"drawBezier",ellipse:"drawEllipse","function":"draw",image:"drawImage",line:"drawLine",path:"drawPath",polygon:"drawPolygon",slice:"drawSlice",quadratic:"drawQuadratic",rectangle:"drawRect",text:"drawText",vector:"drawVector",save:"saveCanvas",restore:"restoreCanvas",rotate:"rotateCanvas",scale:"scaleCanvas",translate:"translateCanvas"};
f.fn.draw=function c(a){var b,g,e=new F(a);if(X.drawings[e.type]&&"function"!==e.type)this[X.drawings[e.type]](a);else for(b=0;b<this.length;b+=1)if(f(this[b]),g=K(this[b]))e=new F(a),O(this[b],e,a,c),e.visible&&e.fn&&e.fn.call(this[b],g,e);return this};f.fn.clearCanvas=function a(b){var g,e,k=new F(b);for(g=0;g<this.length;g+=1)if(e=K(this[g]))k.width===h||k.height===h?(e.save(),e.setTransform(1,0,0,1,0,0),e.clearRect(0,0,this[g].width,this[g].height),e.restore()):(O(this[g],k,b,a),R(this[g],e,k,
k.width,k.height),e.clearRect(k.x-k.width/2,k.y-k.height/2,k.width,k.height),k._transformed&&e.restore());return this};f.fn.saveCanvas=function b(g){var e,k,f,h,x;for(e=0;e<this.length;e+=1)if(k=K(this[e]))for(h=L(this[e]),f=new F(g),O(this[e],f,g,b),x=0;x<f.count;x+=1)fa(k,h);return this};f.fn.restoreCanvas=function g(e){var k,f,h,x,A;for(k=0;k<this.length;k+=1)if(f=K(this[k]))for(x=L(this[k]),h=new F(e),O(this[k],h,e,g),A=0;A<h.count;A+=1){var J=f,z=x;0===z.savedTransforms.length?z.transforms=la(pa):
(J.restore(),z.transforms=z.savedTransforms.pop())}return this};f.fn.rotateCanvas=function e(k){var f,h,x,A;for(f=0;f<this.length;f+=1)if(h=K(this[f]))A=L(this[f]),x=new F(k),O(this[f],x,k,e),x.autosave&&fa(h,A),za(h,x,A.transforms);return this};f.fn.scaleCanvas=function k(f){var h,x,A,J;for(h=0;h<this.length;h+=1)if(x=K(this[h]))J=L(this[h]),A=new F(f),O(this[h],A,f,k),A.autosave&&fa(x,J),Aa(x,A,J.transforms);return this};f.fn.translateCanvas=function Ua(f){var h,A,J,z;for(h=0;h<this.length;h+=1)if(A=
K(this[h]))z=L(this[h]),J=new F(f),O(this[h],J,f,Ua),J.autosave&&fa(A,z),Ba(A,J,z.transforms);return this};f.fn.drawRect=function y(f){var h,J,z,G,u,p,m,B,E;for(h=0;h<this.length;h+=1)if(J=K(this[h]))z=new F(f),O(this[h],z,f,y),z.visible&&(R(this[h],J,z,z.width,z.height),S(this[h],J,z),J.beginPath(),z.width&&z.height&&(G=z.x-z.width/2,u=z.y-z.height/2,(B=cb(z.cornerRadius))?(p=z.x+z.width/2,m=z.y+z.height/2,0>z.width&&(E=G,G=p,p=E),0>z.height&&(E=u,u=m,m=E),0>p-G-2*B&&(B=(p-G)/2),0>m-u-2*B&&(B=(m-
u)/2),J.moveTo(G+B,u),J.lineTo(p-B,u),J.arc(p-B,u+B,B,3*D/2,2*D,C),J.lineTo(p,m-B),J.arc(p-B,m-B,B,0,D/2,C),J.lineTo(G+B,m),J.arc(G+B,m-B,B,D/2,D,C),J.lineTo(G,u+B),J.arc(G+B,u+B,B,D,3*D/2,C),z.closed=v):J.rect(G,u,z.width,z.height)),T(this[h],J,z),W(this[h],J,z));return this};f.fn.drawArc=function x(f){var h,z,G;for(h=0;h<this.length;h+=1)if(z=K(this[h]))G=new F(f),O(this[h],G,f,x),G.visible&&(R(this[h],z,G,2*G.radius),S(this[h],z,G),z.beginPath(),Ka(this[h],z,G,G),T(this[h],z,G),W(this[h],z,G));
return this};f.fn.drawEllipse=function A(f){var h,G,u,p,m;for(h=0;h<this.length;h+=1)if(G=K(this[h]))u=new F(f),O(this[h],u,f,A),u.visible&&(R(this[h],G,u,u.width,u.height),S(this[h],G,u),p=u.width*(4/3),m=u.height,G.beginPath(),G.moveTo(u.x,u.y-m/2),G.bezierCurveTo(u.x-p/2,u.y-m/2,u.x-p/2,u.y+m/2,u.x,u.y+m/2),G.bezierCurveTo(u.x+p/2,u.y+m/2,u.x+p/2,u.y-m/2,u.x,u.y-m/2),T(this[h],G,u),u.closed=v,W(this[h],G,u));return this};f.fn.drawPolygon=function J(f){var h,u,p,m,B,E,M,w,n,l;for(h=0;h<this.length;h+=
1)if(u=K(this[h]))if(p=new F(f),O(this[h],p,f,J),p.visible){R(this[h],u,p,2*p.radius);S(this[h],u,p);B=2*D/p.sides;E=B/2;m=E+D/2;M=p.radius*N(E);u.beginPath();for(l=0;l<p.sides;l+=1)w=p.x+p.radius*N(m),n=p.y+p.radius*Q(m),u.lineTo(w,n),p.concavity&&(w=p.x+(M+-M*p.concavity)*N(m+E),n=p.y+(M+-M*p.concavity)*Q(m+E),u.lineTo(w,n)),m+=B;T(this[h],u,p);p.closed=v;W(this[h],u,p)}return this};f.fn.drawSlice=function z(h){var u,p,m,B,E;for(u=0;u<this.length;u+=1)if(f(this[u]),p=K(this[u]))m=new F(h),O(this[u],
m,h,z),m.visible&&(R(this[u],p,m,2*m.radius),S(this[u],p,m),m.start*=m._toRad,m.end*=m._toRad,m.start-=D/2,m.end-=D/2,m.start=Ja(m.start),m.end=Ja(m.end),m.end<m.start&&(m.end+=2*D),B=(m.start+m.end)/2,E=m.radius*m.spread*N(B),B=m.radius*m.spread*Q(B),m.x+=E,m.y+=B,p.beginPath(),p.arc(m.x,m.y,m.radius,m.start,m.end,m.ccw),p.lineTo(m.x,m.y),T(this[u],p,m),m.closed=v,W(this[u],p,m));return this};f.fn.drawLine=function G(h){var f,m,B;for(f=0;f<this.length;f+=1)if(m=K(this[f]))B=new F(h),O(this[f],B,
h,G),B.visible&&(R(this[f],m,B),S(this[f],m,B),m.beginPath(),Ma(this[f],m,B,B),T(this[f],m,B),W(this[f],m,B));return this};f.fn.drawQuadratic=function u(f){var h,B,E;for(h=0;h<this.length;h+=1)if(B=K(this[h]))E=new F(f),O(this[h],E,f,u),E.visible&&(R(this[h],B,E),S(this[h],B,E),B.beginPath(),Na(this[h],B,E,E),T(this[h],B,E),W(this[h],B,E));return this};f.fn.drawBezier=function p(h){var f,E,M;for(f=0;f<this.length;f+=1)if(E=K(this[f]))M=new F(h),O(this[f],M,h,p),M.visible&&(R(this[f],E,M),S(this[f],
E,M),E.beginPath(),Oa(this[f],E,M,M),T(this[f],E,M),W(this[f],E,M));return this};f.fn.drawVector=function m(f){var h,M,w;for(h=0;h<this.length;h+=1)if(M=K(this[h]))w=new F(f),O(this[h],w,f,m),w.visible&&(R(this[h],M,w),S(this[h],M,w),M.beginPath(),Ra(this[h],M,w,w),T(this[h],M,w),W(this[h],M,w));return this};f.fn.drawPath=function B(h){var f,w,n,l,s;for(f=0;f<this.length;f+=1)if(w=K(this[f]))if(n=new F(h),O(this[f],n,h,B),n.visible){R(this[f],w,n);S(this[f],w,n);w.beginPath();for(l=1;v;)if(s=n["p"+
l],s!==q)s=new F(s),"line"===s.type?Ma(this[f],w,n,s):"quadratic"===s.type?Na(this[f],w,n,s):"bezier"===s.type?Oa(this[f],w,n,s):"vector"===s.type?Ra(this[f],w,n,s):"arc"===s.type&&Ka(this[f],w,n,s),l+=1;else break;T(this[f],w,n);W(this[f],w,n)}return this};f.fn.drawText=function E(M){var w,n,l,s,$,t,H,q,v,C;for(w=0;w<this.length;w+=1)if(f(this[w]),n=K(this[w]))if(l=new F(M),s=O(this[w],l,M,E),l.visible){n.textBaseline=l.baseline;n.textAlign=l.align;ta(this[w],n,l);$=l.maxWidth!==h?Sa(n,l):l.text.toString().split("\n");
ua(this[w],n,l,$);s&&(s.width=l.width,s.height=l.height);R(this[w],n,l,l.width,l.height);S(this[w],n,l);H=l.x;"left"===l.align?l.respectAlign?l.x+=l.width/2:H-=l.width/2:"right"===l.align&&(l.respectAlign?l.x-=l.width/2:H+=l.width/2);if(l.radius)for(H=Y(l.fontSize),l.letterSpacing===h&&(l.letterSpacing=H/500),s=0;s<$.length;s+=1){n.save();n.translate(l.x,l.y);t=$[s];l.flipArcText&&(t=t.split(""),t.reverse(),t=t.join(""));q=t.length;n.rotate(-(D*l.letterSpacing*(q-1))/2);for(C=0;C<q;C+=1)v=t[C],0!==
C&&n.rotate(D*l.letterSpacing),n.save(),n.translate(0,-l.radius),l.flipArcText&&n.scale(-1,-1),n.fillText(v,0,0),"transparent"!==l.fillStyle&&(n.shadowColor="transparent"),0!==l.strokeWidth&&n.strokeText(v,0,0),n.restore();l.radius-=H;l.letterSpacing+=H/(1E3*D);n.restore()}else for(s=0;s<$.length;s+=1)t=$[s],q=l.y+s*l.height/$.length-($.length-1)*l.height/$.length/2,n.shadowColor=l.shadowColor,n.fillText(t,H,q),"transparent"!==l.fillStyle&&(n.shadowColor="transparent"),0!==l.strokeWidth&&n.strokeText(t,
H,q);q=0;"top"===l.baseline?q+=l.height/2:"bottom"===l.baseline&&(q-=l.height/2);l._event&&(n.beginPath(),n.rect(l.x-l.width/2,l.y-l.height/2+q,l.width,l.height),T(this[w],n,l),n.closePath());l._transformed&&n.restore()}ca.propCache=l;return this};f.fn.measureText=function(f){var h,w;h=this.getLayer(f);if(!h||h&&!h._layer)h=new F(f);if(f=K(this[0]))ta(this[0],f,h),w=Sa(f,h),ua(this[0],f,h,w);return h};f.fn.drawImage=function M(w){function n(l,n,t,r,s){return function(){var w=f(l);r.width===h&&r.sWidth===
h&&(r.width=r.sWidth=I.width);r.height===h&&r.sHeight===h&&(r.height=r.sHeight=I.height);s&&(s.width=r.width,s.height=r.height);r.sWidth!==h&&r.sHeight!==h&&r.sx!==h&&r.sy!==h?(r.width===h&&(r.width=r.sWidth),r.height===h&&(r.height=r.sHeight),r.cropFromCenter&&(r.sx+=r.sWidth/2,r.sy+=r.sHeight/2),0>r.sy-r.sHeight/2&&(r.sy=r.sHeight/2),r.sy+r.sHeight/2>I.height&&(r.sy=I.height-r.sHeight/2),0>r.sx-r.sWidth/2&&(r.sx=r.sWidth/2),r.sx+r.sWidth/2>I.width&&(r.sx=I.width-r.sWidth/2),R(l,n,r,r.width,r.height),
S(l,n,r),n.drawImage(I,r.sx-r.sWidth/2,r.sy-r.sHeight/2,r.sWidth,r.sHeight,r.x-r.width/2,r.y-r.height/2,r.width,r.height)):(R(l,n,r,r.width,r.height),S(l,n,r),n.drawImage(I,r.x-r.width/2,r.y-r.height/2,r.width,r.height));n.beginPath();n.rect(r.x-r.width/2,r.y-r.height/2,r.width,r.height);T(l,n,r);n.closePath();r._transformed&&n.restore();ya(n,t,r);r.layer?P(w,t,s,"load"):r.load&&r.load.call(w[0],s);r.layer&&(s._masks=t.transforms.masks.slice(0),r._next&&w.drawLayers({clear:C,resetFire:v,index:r._next}))}}
var l,s,q,t,H,D,I,wa,N,Q=ca.imageCache;for(s=0;s<this.length;s+=1)if(l=this[s],q=K(this[s]))t=L(this[s]),H=new F(w),D=O(this[s],H,w,M),H.visible&&(N=H.source,wa=N.getContext,N.src||wa?I=N:N&&(Q[N]&&Q[N].complete?I=Q[N]:(I=new Ta,N.match(/^data:/i)||(I.crossOrigin=H.crossOrigin),I.src=N,Q[N]=I)),I&&(I.complete||wa?n(l,q,t,H,D)():(I.onload=n(l,q,t,H,D),I.src=I.src)));return this};f.fn.createPattern=function(q){function w(){t=l.createPattern(v,s.repeat);s.load&&s.load.call(n[0],t)}var n=this,l,s,v,t,
H;(l=K(n[0]))?(s=new F(q),H=s.source,da(H)?(v=f("<canvas />")[0],v.width=s.width,v.height=s.height,q=K(v),H.call(v,q),w()):(q=H.getContext,H.src||q?v=H:(v=new Ta,H.match(/^data:/i)||(v.crossOrigin=s.crossOrigin),v.src=H),v.complete||q?w():(v.onload=w,v.src=v.src))):t=h;return t};f.fn.createGradient=function(f){var w,n=[],l,s,v,t,H,C,I;f=new F(f);if(w=K(this[0])){f.x1=f.x1||0;f.y1=f.y1||0;f.x2=f.x2||0;f.y2=f.y2||0;w=f.r1!==h&&f.r2!==h?w.createRadialGradient(f.x1,f.y1,f.r1,f.x2,f.y2,f.r2):w.createLinearGradient(f.x1,
f.y1,f.x2,f.y2);for(t=1;f["c"+t]!==q;t+=1)f["s"+t]!==q?n.push(f["s"+t]):n.push(h);l=n.length;n[0]===h&&(n[0]=0);n[l-1]===h&&(n[l-1]=1);for(t=0;t<l;t+=1){if(n[t]!==h){C=1;I=0;s=n[t];for(H=t+1;H<l;H+=1)if(n[H]!==h){v=n[H];break}else C+=1;s>v&&(n[H]=n[t])}else n[t]===h&&(I+=1,n[t]=s+I*((v-s)/C));w.addColorStop(n[t],f["c"+(t+1)])}}else w=h;return w};f.fn.setPixels=function w(f){var l,s,q,t,v,C,I,D,L;for(s=0;s<this.length;s+=1)if(l=this[s],q=K(l)){t=new F(f);O(l,t,f,w);R(this[s],q,t,t.width,t.height);
if(t.width===h||t.height===h)t.width=l.width,t.height=l.height,t.x=t.width/2,t.y=t.height/2;if(0!==t.width&&0!==t.height){C=q.getImageData(t.x-t.width/2,t.y-t.height/2,t.width,t.height);I=C.data;L=I.length;if(t.each)for(D=0;D<L;D+=4)v={r:I[D],g:I[D+1],b:I[D+2],a:I[D+3]},t.each.call(l,v,t),I[D]=v.r,I[D+1]=v.g,I[D+2]=v.b,I[D+3]=v.a;q.putImageData(C,t.x-t.width/2,t.y-t.height/2);q.restore()}}return this};f.fn.getCanvasImage=function(f,n){var l,s=h;0!==this.length&&(l=this[0],l.toDataURL&&(n===q&&(n=
1),s=l.toDataURL("image/"+f,n)));return s};f.fn.detectPixelRatio=function(h){var n,l,s,q,t,C,D;for(l=0;l<this.length;l+=1)n=this[l],f(this[l]),s=K(n),D=L(this[l]),D.scaled||(q=U.devicePixelRatio||1,t=s.webkitBackingStorePixelRatio||s.mozBackingStorePixelRatio||s.msBackingStorePixelRatio||s.oBackingStorePixelRatio||s.backingStorePixelRatio||1,q/=t,1!==q&&(t=n.width,C=n.height,n.width=t*q,n.height=C*q,n.style.width=t+"px",n.style.height=C+"px",s.scale(q,q)),D.pixelRatio=q,D.scaled=v,h&&h.call(n,q));
return this};Z.clearCache=function(){for(var f in ca)ca.hasOwnProperty(f)&&(ca[f]={})};f.support.canvas=f("<canvas />")[0].getContext!==q;aa(Z,{defaults:ma,setGlobalProps:S,transformShape:R,detectEvents:T,closePath:W,setCanvasFont:ta,measureText:ua});f.jCanvas=Z;f.jCanvasObject=F});