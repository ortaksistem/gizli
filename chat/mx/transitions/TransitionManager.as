class mx.transitions.TransitionManager
{
    var __set__content, _transitions, _content, removeEventListener, addEventListener, __get__content, _contentAppearance, _innerBounds, _outerBounds, _width, _height, __get__numInTransitions, _triggerEvent, dispatchEvent, __get__numOutTransitions, __get__contentAppearance, __get__numTransitions, __get__transitions;
    function TransitionManager(content)
    {
        this.__set__content(content);
        _transitions = {};
    } // End of the function
    function set content(c)
    {
        this.removeEventListener("allTransitionsInDone", _content);
        this.removeEventListener("allTransitionsOutDone", _content);
        _content = c;
        this.saveContentAppearance();
        this.addEventListener("allTransitionsInDone", _content);
        this.addEventListener("allTransitionsOutDone", _content);
        //return (this.content());
        null;
    } // End of the function
    function get content()
    {
        return (_content);
    } // End of the function
    function get transitions()
    {
        return (_transitions);
    } // End of the function
    function get numTransitions()
    {
        var _loc2 = 0;
        for (var _loc3 in _transitions)
        {
            ++_loc2;
        } // end of for...in
        return (_loc2);
    } // End of the function
    function get numInTransitions()
    {
        var _loc3 = 0;
        var _loc2 = _transitions;
        for (var _loc4 in _loc2)
        {
            if (!_loc2[_loc4].direction)
            {
                ++_loc3;
            } // end if
        } // end of for...in
        return (_loc3);
    } // End of the function
    function get numOutTransitions()
    {
        var _loc3 = 0;
        var _loc2 = _transitions;
        for (var _loc4 in _loc2)
        {
            if (_loc2[_loc4].direction)
            {
                ++_loc3;
            } // end if
        } // end of for...in
        return (_loc3);
    } // End of the function
    function get contentAppearance()
    {
        return (_contentAppearance);
    } // End of the function
    static function start(content, transParams)
    {
        if (content.__transitionManager == undefined)
        {
            content.__transitionManager = new mx.transitions.TransitionManager(content);
        } // end if
        if (transParams.direction == 1)
        {
            content.__transitionManager._triggerEvent = "hide";
        }
        else
        {
            content.__transitionManager._triggerEvent = "reveal";
        } // end else if
        return (content.__transitionManager.startTransition(transParams));
    } // End of the function
    function startTransition(transParams)
    {
        this.removeTransition(this.findTransition(transParams));
        var _loc3 = transParams.type;
        var _loc2 = new _loc3[undefined](_content, transParams, this);
        this.addTransition(_loc2);
        _loc2.start();
        return (_loc2);
    } // End of the function
    function addTransition(trans)
    {
        trans.ID = IDCount = ++mx.transitions.TransitionManager.IDCount;
        _transitions[trans.ID] = trans;
        return (trans);
    } // End of the function
    function removeTransition(trans)
    {
        if (_transitions[trans.ID] == undefined)
        {
            return (false);
        } // end if
        trans.cleanUp();
        return (delete _transitions[trans.ID]);
    } // End of the function
    function findTransition(transParams)
    {
        var _loc2;
        for (var _loc4 in _transitions)
        {
            _loc2 = _transitions[_loc4];
            if (_loc2.type == transParams.type)
            {
                return (_loc2);
            } // end if
        } // end of for...in
        return;
    } // End of the function
    function removeAllTransitions()
    {
        for (var _loc2 in _transitions)
        {
            _transitions[_loc2].cleanUp();
            this.removeTransition(_transitions[_loc2]);
        } // end of for...in
    } // End of the function
    function saveContentAppearance()
    {
        var _loc2 = _content;
        if (_contentAppearance == undefined)
        {
            var _loc3 = _contentAppearance = {};
            for (var _loc4 in _visualPropList)
            {
                _loc3[_loc4] = _loc2[_loc4];
            } // end of for...in
            _loc3.colorTransform = new Color(_loc2).getTransform();
        } // end if
        _innerBounds = _loc2.getBounds(targetPath(_loc2));
        _outerBounds = _loc2.getBounds(targetPath(_loc2._parent));
        _width = _loc2._width;
        _height = _loc2._height;
    } // End of the function
    function restoreContentAppearance()
    {
        var _loc2 = _content;
        var _loc3 = _contentAppearance;
        for (var _loc4 in _visualPropList)
        {
            _loc2[_loc4] = _loc3[_loc4];
        } // end of for...in
        new Color(_loc2).setTransform(_loc3.colorTransform);
    } // End of the function
    function transitionInDone(e)
    {
        this.removeTransition(e.target);
        if (this.__get__numInTransitions() == 0)
        {
            var _loc2;
            _loc2 = _content._visible;
            if (_triggerEvent == "hide" || _triggerEvent == "hideChild")
            {
                _content._visible = false;
            } // end if
            if (_loc2)
            {
                this.dispatchEvent({type: "allTransitionsInDone", target: this});
            } // end if
        } // end if
    } // End of the function
    function transitionOutDone(e)
    {
        this.removeTransition(e.target);
        if (this.__get__numOutTransitions() == 0)
        {
            this.restoreContentAppearance();
            var _loc2;
            _loc2 = _content._visible;
            if (_loc2 && (_triggerEvent == "hide" || _triggerEvent == "hideChild"))
            {
                _content._visible = false;
            } // end if
            updateAfterEvent();
            if (_loc2)
            {
                this.dispatchEvent({type: "allTransitionsOutDone", target: this});
            } // end if
        } // end if
    } // End of the function
    function toString()
    {
        return ("[TransitionManager]");
    } // End of the function
    static var IDCount = 0;
    var type = mx.transitions.TransitionManager;
    var className = "TransitionManager";
    var _visualPropList = {_x: null, _y: null, _xscale: null, _yscale: null, _alpha: null, _rotation: null};
    static var __mixinFED = mx.events.EventDispatcher.initialize(mx.transitions.TransitionManager.prototype);
} // End of Class
