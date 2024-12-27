class mx.transitions.Fade extends mx.transitions.Transition
{
    var manager, _alphaFinal, _content;
    function Fade(content, transParams, manager)
    {
        super();
        this.init(content, transParams, manager);
    } // End of the function
    function init(content, transParams, manager)
    {
        super.init(content, transParams, manager);
        _alphaFinal = manager.contentAppearance._alpha;
    } // End of the function
    function _render(p)
    {
        _content._alpha = _alphaFinal * p;
    } // End of the function
    var type = mx.transitions.Fade;
    var className = "Fade";
} // End of Class
