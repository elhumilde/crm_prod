<?php

/**
 * sfTCPDF class.
 *
 * @package    sfTCPDFPlugin
 * @author     Vernet Loïc aka COil <qrf_coil]at[yahoo[dot]fr>
 * @link       http://www.symfony-project.org/plugins/sfTCPDFPlugin
 * @link       http://www.tcpdf.org
 * @link       http://sourceforge.net/projects/tcpdf/
 */

class KsfTCPDF extends TCPDF
{
  /**
   * When set this method is called as a header function.
   * The variable must be a valid argument to call_user_func
   *
   * @var mixed
   */
  public $headerCallback = null;

  /**
   * When set this method is called as a header function.
   * The variable must be a valid argument to call_user_func
   *
   * @var mixed
   */
  public $footerCallback = null;

  /**
   * Holds the data set via php magic methods
   */
  protected $userData = array();

  /**
   * Instantiate TCPDF lib.
   *
   * @param string $orientation
   * @param string $unit
   * @param string $format
   * @param boolean $unicode
   * @param string $encoding
   */
  public function __construct($orientation = 'P', $unit = 'mm', $format = 'A4', $unicode = true, $encoding = "UTF-8")
  {
    parent::__construct($orientation, $unit, $format, $unicode, $encoding);
  }

  /**
   * This method is used to render the page header.
   * It is automatically called by AddPage() and could be overwritten using a Callback.
   *
   * @access public
   * @see $headerCallback
   */
  public function Header()
  {
    if ($this->print_header)
    {
      if (is_null($this->headerCallback))
      {
	      	// Logo
      		// le chemain de l'image est : plugins/sfTCPDFPlugin/lib/tcpdf/images/ERP_logo.png
	      	//$image_file = K_PATH_IMAGES.'logo_ERP.jpg';
	      	//$this->Image($image_file, 10, 10, 54, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
	      		      	
	        // Set font
	        $this->SetFont('TIMES', 'N', 10);
	        $signature = <<<EOD
	        <br><br>
<table width="500px" border="2" bordercolor="#000000">
      	          		                         
      	          		                                 <tr><td width="40%"><br><div align="center">
												<img src="/img/logo_ERP.png"  width="170" height="70" />
      	          		                                 </div> 
      	                                              </td >
      	          		  		                       <td  width="48%" bgcolor="#FFFFFF" ><br><br/><b><div align="center"><span style="font-size:55px"><strong>BON DE COMMANDE</strong> 
      	          		                            </span>
      	          		                          </div></b>
      	          		                                      </td> 
      	          		                                      <td width="42%" ><br/>
      	          		                                      <div align="left"><span style="font-size:35px">  Code.MG-FR12<br/>&nbsp; Version : 02 <br/>&nbsp; Date d'application :11/05/2012 <br/>
      	          		                                      &nbsp; Pages : {$this->getAliasNumPage()} / {$this->getAliasNbPages()}<br>
      	          		                                      </span></div>
      	          		                                      
      	          		                                      </td >              
      	          		                                </tr>
      	          		
      	          		                       </table> 
EOD;

      	$this->writeHTML($signature);
	        
      }
      else
      {
        call_user_func($this->headerCallback, $this);
      }
    }
  }

  /**
   * This method is used to render the page footer.
   * It is automatically called by AddPage() and could be overwritten using a Callback.
   *
   * @access public
   * @see $footerCallback
   */
  public function Footer()
  {
    if ($this->print_footer)
    {
      if (is_null($this->footerCallback))
      {
      	// Set font
      	$this->SetFont('TIMES', '', 8);


				// Logo
		      	// le chemain de l'image est : plugins/sfTCPDFPlugin/lib/tcpdf/images/iso-9001-200.jpg
		  $image_file = $this->print_image_footer ? K_PATH_IMAGES."iso-9001-200.jpg" : K_PATH_IMAGES."_blank.jpg";
		 $this->Image($image_file, 10, 273, 25, "", "JPG", "", "T", false, 300, "", false, false, 0, false, false, false);


      	//Signature + Page Number
      	
$signature = <<<EOD
<div color="#555555">
34,Boulevard Moulay Slimane 20290 Casablanca - Maroc<br>
Tél :(+212)05 22 34 57(LG) - Fax :(+212)05 22 24 40 41<br>
E-mail :ERP@ERP.ma<br>
ERP S.A Capital 27 777 700 Dhs - R.C casa : 38363 - CNSS : 1796301 - I.F : 1049381 - Patente : 37994004<br>
		
</div>
EOD;

      	$this->writeHTML($signature);
      }
      else
      {
        call_user_func($this->footerCallback, $this);
      }
    }
  }

  /**
   * Magic setter.
   *
   * @param String $name
   * @param mixed $value
   */
  public function __set($name, $value)
  {
    $this->userData[$name] = $value;
  }

  /**
   * Magic getter.
   *
   * @param String $name Name of data key to return
   * @return mixed
   */
  public function __get($name)
  {
    if (array_key_exists($name, $this->userData))
    {
      return $this->userData[$name];
    }

    $trace = debug_backtrace();    
    trigger_error(
      'Undefined property call via __get(): '. $name. ' in ' . $trace[0]['file']. ' on line ' . $trace[0]['line'],
      E_USER_NOTICE
    );
    
    return null;
  }

  /**
   * Test existence of user data.
   *
   * @param String $name
   * @return Boolean
   */
  public function __isset($name)
  {
    return isset($this->userData[$name]);
  }

  /**
   * Unset user data.
   *
   * @param String $name
   */
  public function __unset($name)
  {
    unset($this->userData[$name]);
  }
}