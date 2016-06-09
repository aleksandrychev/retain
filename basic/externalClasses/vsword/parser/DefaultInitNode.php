<?php

/**
 *  Class DefaultInitNode processes tags.
 *
 * @version 1.0.3
 * @author v.raskin
 * @package vsword.parser
 */
class DefaultInitNode implements IInitNode
{

    /**
     * @var VsWord
     */
    protected $doc;

    /**
     * @param VsWord $doc Nead for add files
     */
    public function __construct(VsWord $doc = null)
    {
        $this->doc = $doc;
    }

    /**
     * @return VsWord
     */
    public function getVsWord()
    {
        return $this->doc;
    }

    /**
     * @param string $tagName
     * @param mixed $attributes
     * @return Node
     */
    function initNode($tagName, $attributes)
    {

        //default implemenation
        switch (strtolower($tagName)) {
            case 'img': //image

                if (!is_null($this->getVsWord()) && isset($attributes['src']) && @file_get_contents($attributes['src'],
                        false, null, -1, 1) !== false
                ) {
                    $file = $attributes['src'];
                    $attach = $this->getVsWord()->getAttachImage($file);
                    $drawingNode = new DrawingNode();
                    $drawingNode->addImage($attach);
                    return $drawingNode;
                }
                break;
            case 'p':
            case 'div':

                $p = new PCompositeNode();
                if (isset($attributes['align'])) {
                    $p->addPNodeStyle(new AlignNode($attributes['align']));
                }
                return $p;
                break;
            case 'br':
            case 'hr':
                return new BrNode();
                break;
            case 'span':
                return new RCompositeNode();
                break;
            case 'i':
            case 'em':
                $r = new RCompositeNode();
                $r->addTextStyle(new ItalicStyleNode());
                return $r;
                break;
            case 'b':
            case 'strong':
            case 'h4':
            case 'h5':
                $r = new RCompositeNode();
                $r->addTextStyle(new BoldStyleNode());
                return $r;
                break;
            case 'u':
                $r = new RCompositeNode();
                $r->addTextStyle(new UnderlineStyleNode());
                return $r;
                break;
            case 'h1':
                $p = new PCompositeNode();
                $r = new RCompositeNode();
                $p->addNode($r);
                $r->addTextStyle(new BoldStyleNode());
                $r->addTextStyle(new FontSizeStyleNode(36));
                return $p;
                break;
            case 'h2':
                $p = new PCompositeNode();
                $r = new RCompositeNode();
                $p->addNode($r);
                $r->addTextStyle(new BoldStyleNode());
                $r->addTextStyle(new FontSizeStyleNode(26));
                return $p;
                break;
            case 'h3':
                $p = new PCompositeNode();
                $r = new RCompositeNode();
                $p->addNode($r);
                $r->addTextStyle(new BoldStyleNode());
                $r->addTextStyle(new FontSizeStyleNode(18));
                return $p;
                break;
            case 'table':
                return new TableCompositeNode();
                break;
            case 'tr':
                return new TableRowCompositeNode();
                break;
            case 'td':
            case 'th':
                $td = new TableColCompositeNode();
                $td->addNode(new PCompositeNode());
                return $td;
                break;
            case 'ul':
            case 'ol':
                return new ListCompositeNode();
                break;
            case 'li':
                return new ListItemCompositeNode();
                break;
        }
        return new EmptyCompositeNode();
    }
}