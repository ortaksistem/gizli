class it.sephiroth.tooltip extends mx.core.UIComponent
{
    var tManager, _tf, boundingBox_mc, _visible, showID, hideID, getBounds, _height, _width, _parent, _x, _y, dispatchEvent, createLabel, textBoxLabel, clear, __get__html, swapDepths, __get__borderColor, lineStyle, __get__backgroundColor, beginFill, drawRect, endFill, __get___xshadow, __get___yshadow, invalidate, _text, __get__text, _html, __set___xshadow, __set___yshadow, __set__backgroundColor, __set__borderColor, __set__html, __set__text;
    function tooltip()
    {
        super();
        tManager = new mx.transitions.TransitionManager(this);
        tManager.addEventListener("allTransitionsInDone", this);
        tManager.addEventListener("allTransitionsOutDone", this);
        mx.events.EventDispatcher.initialize(this);
    } // End of the function
    function init()
    {
        super.init();
        _tf = new TextFormat();
        _tf.font = "Tahoma";
        _tf.size = 11;
        boundingBox_mc._visible = false;
        boundingBox_mc._width = boundingBox_mc._height = 0;
        _visible = false;
        displayed = false;
    } // End of the function
    function show(time, followMouse)
    {
        clearInterval(showID);
        clearInterval(hideID);
        _visible = false;
        tManager.removeAllTransitions();
        tManager.restoreContentAppearance();
        if (time == null || time == undefined || time < 0)
        {
            time = 0;
        } // end if
        if (followMouse == null || followMouse == undefined)
        {
            followMouse = true;
        } // end if
        showID = setInterval(_show, time, this, followMouse);
    } // End of the function
    function hide(time)
    {
        clearInterval(hideID);
        clearInterval(showID);
        if (displayed == false)
        {
            return;
        } // end if
        if (time == null || time == undefined || time < 0)
        {
            time = 0;
        } // end if
        hideID = setInterval(_hide, time, this);
    } // End of the function
    function _show(mc, followMouse)
    {
        clearInterval(mc.showID);
        mc.displayed = true;
        if (followMouse == true)
        {
            var _loc2 = new Object();
            _loc2.x = mc._parent._xmouse;
            _loc2.y = mc._parent._ymouse;
            mc._x = _loc2.x - 10;
            mc._y = _loc2.y - mc.textBoxLabel.height - 5;
        } // end if
        mc.invalidatePosition();
        var _loc3 = mc.tManager.startTransition({direction: 0, duration: 1, easing: mx.transitions.easing.None.easeNone, type: mx.transitions.Fade});
        _loc3.removeEventListener("transitionProgress", mc);
        _loc3.addEventListener("transitionProgress", mc);
    } // End of the function
    function invalidatePosition()
    {
        var _loc4 = this.getBounds(_root);
        var _loc3 = new Object();
        _loc3.x = _loc4.xMin;
        _loc3.y = _loc4.yMin;
        if (_loc4.yMax > Stage.height)
        {
            _loc3.y = Stage.height - _height - 5;
        }
        else if (_loc4.yMin < 0)
        {
            _loc3.y = 5;
        } // end else if
        if (_loc4.xMax > Stage.width)
        {
            _loc3.x = Stage.width - _width - 5;
        }
        else if (_loc4.xMin < 0)
        {
            _loc3.x = 0;
        } // end else if
        _parent.globalToLocal(_loc3);
        _x = _loc3.x;
        _y = _loc3.y;
    } // End of the function
    function _hide(mc)
    {
        clearInterval(mc.hideID);
        mc.tManager.removeAllTransitions();
        mc.displayed = false;
        var _loc2 = mc.tManager.startTransition({direction: 1, duration: 5.000000E-001, easing: mx.transitions.easing.None.easeNone, type: mx.transitions.Fade});
        _loc2.removeEventListener("transitionProgress", mc);
        _loc2.addEventListener("transitionProgress", mc);
    } // End of the function
    function transitionProgress(event)
    {
    } // End of the function
    function allTransitionsInDone(evt)
    {
        displayed = true;
        var _loc2 = new Object();
        _loc2.type = "allTransitionsInDone";
        _loc2.target = this;
        this.dispatchEvent(_loc2);
    } // End of the function
    function allTransitionsOutDone(evt)
    {
        _visible = false;
        displayed = false;
        var _loc2 = new Object();
        _loc2.type = "allTransitionsOutDone";
        _loc2.target = this;
        this.dispatchEvent(_loc2);
    } // End of the function
    function createChildren()
    {
        textBoxLabel = this.createLabel("textBoxLabel", 1);
        textBoxLabel.selectable = false;
        textBoxLabel.multiline = true;
        textBoxLabel.autoSize = true;
    } // End of the function
    function draw()
    {
        this.clear();
        if (this.__get__html() == true)
        {
            textBoxLabel.html = true;
            textBoxLabel.htmlText = text;
        }
        else
        {
            textBoxLabel.html = false;
            textBoxLabel.text = text;
        } // end else if
        textBoxLabel.setTextFormat(_tf);
        this.swapDepths(_parent.getNextHighestDepth());
        textBoxLabel.setSize(textBoxLabel.textWidth + 5, textBoxLabel.textHeight + 3);
        var _loc3 = textBoxLabel.width;
        var _loc2 = textBoxLabel.height;
        this.lineStyle(1.000000E-001, this.__get__borderColor(), 100);
        this.beginFill(this.__get__backgroundColor());
        this.drawRect(0, 0, _loc3 + 4, _loc2 + 2);
        this.endFill();
        var _loc5 = this.__get___xshadow();
        var _loc4 = this.__get___yshadow();
        this.lineStyle(0, 0, 0);
        this.beginFill(0, 60);
        this.drawRect(_loc3 + 4, _loc4 + 2, _loc3 + 5, _loc2 + 3);
        this.drawRect(_loc5 + 2, _loc2 + 2, _loc3 + 4, _loc2 + 3);
        this.endFill();
        this.beginFill(0, 30);
        this.drawRect(_loc3 + 4, _loc4 + 1, _loc3 + 6, _loc4 + 2);
        this.drawRect(_loc5 + 1, _loc2 + 2, _loc5 + 2, _loc2 + 4);
        this.drawRect(_loc3 + 5, _loc4 + 2, _loc3 + 6, _loc2 + 3);
        this.drawRect(_loc5 + 2, _loc2 + 3, _loc3 + 6, _loc2 + 4);
        this.beginFill(0, 15);
        this.drawRect(_loc3 + 4, _loc4, _loc3 + 7, _loc4 + 1);
        this.drawRect(_loc5, _loc2 + 2, _loc5 + 1, _loc2 + 5);
        this.drawRect(_loc3 + 6, _loc4 + 1, _loc3 + 7, _loc2 + 4);
        this.drawRect(_loc5 + 1, _loc2 + 4, _loc3 + 7, _loc2 + 5);
        this.endFill();
        textBoxLabel.move(1, 1);
        _visible = false;
    } // End of the function
    function size()
    {
        this.invalidate();
    } // End of the function
    function toString()
    {
        return ("[ToolTip]");
    } // End of the function
    function set text(testo)
    {
        _text = testo;
        this.invalidate();
        //return (this.text());
        null;
    } // End of the function
    function get text()
    {
        return (_text);
    } // End of the function
    function set backgroundColor(bgColor)
    {
        _backgroundColor = bgColor;
        this.invalidate();
        //return (this.backgroundColor());
        null;
    } // End of the function
    function get backgroundColor()
    {
        return (_backgroundColor);
    } // End of the function
    function set borderColor(col)
    {
        _borderColor = col;
        this.invalidate();
        //return (this.borderColor());
        null;
    } // End of the function
    function get borderColor()
    {
        return (_borderColor);
    } // End of the function
    function setTextFormat(tf)
    {
        _tf = tf;
        this.invalidate();
    } // End of the function
    function getTextFormat()
    {
        return (_tf);
    } // End of the function
    function set html(useHtml)
    {
        if (typeof(useHtml) == "string")
        {
            _html = useHtml.toLowerCase() == "true";
        }
        else
        {
            _html = useHtml;
        } // end else if
        this.invalidate();
        //return (this.html());
        null;
    } // End of the function
    function get html()
    {
        return (_html);
    } // End of the function
    function set _xshadow(num)
    {
        __xshadow = num;
        this.invalidate();
        //return (this._xshadow());
        null;
    } // End of the function
    function get _xshadow()
    {
        return (__xshadow);
    } // End of the function
    function set _yshadow(num)
    {
        __yshadow = num;
        this.invalidate();
        //return (this._yshadow());
        null;
    } // End of the function
    function get _yshadow()
    {
        return (__yshadow);
    } // End of the function
    static var symbolName = "tooltip";
    static var symbolOwner = it.sephiroth.tooltip;
    var depth = 0;
    var _backgroundColor = 16777164;
    var _borderColor = 0;
    var __xshadow = 3;
    var __yshadow = 4;
    var displayed = false;
    var className = "tooltip";
} // End of Class
