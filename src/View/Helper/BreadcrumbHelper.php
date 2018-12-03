< ?php
App::uses('AppHelper', 'View/Helper');
class BreadcrumbHelper extends AppHelper 
{
public $helpers = array('Html','Js' => array('Jquery'));
/*
$links array containing information to create links
'title' => 'Text shown for link'
'url' => url to redirect, can be created by sending the controller and action
'class' => optional, to be added id specific CSS needed
*/
public function create($links)
{
$html = '<div id="path">';
$html .= $this->Js->link($link[0]['title'],$link[0]['url'],
array(
'before' => $this->Js->get('#loading')->effect('fadeIn'), 
// #loading - id to show the gif while content loads
'success' => $this->Js->get('#loading')->effect('fadeOut'),
'update' => '#content', 
// #content - id to update the content on request complete
'class' => $link[0]['class']
)
);
foreach($links as $link)
{
$html .= '<img src="path to image"/>';
// separtor for links, you can also use any symbol, its your application, you are the boss
$html .= $this->Js->link($link[0]['title'],$link[0]['url'],
array(
    'before' => $this->Js->get('#loading')->effect('fadeIn'),
    'success' => $this->Js->get('#loading')->effect('fadeOut'),
    'update' => '#content',
    'class' => $link[0]['class']
)
    );
}
$html .= '</div>';
return $html;
}
}
//3. Add this helper to controller where you want to use..
class TestsController extends AppController
{
var $name = “Tests”;
var $helpers = array('Breadcrumb');
//code specific to your application
}
??
//4. Now, you can use this helper in your view file.
echo $this->Breadcrumb->create(array(
array(
'title' => 'Home',
'url' => array('controller' => 'some_controller','action' => 'some_action'),
'class' => ''
),
array(
'title' => 'Listing Paeg',
'url' => array('controller' => 'some_controller','action' => 'some_action','some_parameters_if_needed'),
'class' => 'current'
),
array(
//more links
)
));
?>