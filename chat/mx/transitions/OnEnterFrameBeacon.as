class mx.transitions.OnEnterFrameBeacon
{
    function OnEnterFrameBeacon()
    {
    } // End of the function
    static function init()
    {
        var _loc4 = _global.MovieClip;
        if (!_root.__OnEnterFrameBeacon)
        {
            mx.transitions.BroadcasterMX.initialize(_loc4);
            var _loc3 = _root.createEmptyMovieClip("__OnEnterFrameBeacon", 9876);
            _loc3.onEnterFrame = function ()
            {
                _global.MovieClip.broadcastMessage("onEnterFrame");
            };
        } // end if
    } // End of the function
} // End of Class
