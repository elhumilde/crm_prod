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

class sfTCPDF extends TCPDF
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
      		$app = sfContext::getInstance()->getConfiguration()->getApplication();
	      	// Logo
      		// le chemain de l'image est : plugins/sfTCPDFPlugin/lib/tcpdf/images/ERP_logo.png
      		$path = "../apps/$app/specifique/Client/".TTS_CLIENT."/_logo/";
	      	$image_file = $path.'logo.jpg';
	      	$this->Image($image_file, 10, 10, '', '', 'JPG', '', 'T', true, 300, '', false, false, 0, false, false, false);
	      		      	
	        // Set font
	        $this->SetFont('TIMES', 'B', 20);
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
<font color="#555555">
		<table width="610" border="0" align=\"right\" cellspacing="0">
				  <tr >
				    <td width="166" align="left" valign="middle" >&nbsp;</td>
				    <td width="130" align="left" valign="middle" >&nbsp;</td>
				    <td width="158" align="left" valign="middle">ERP S.A</td>
				    <td width="148" align="left" valign="middle">34, Bd Moulay Slimane</td>
				  </tr>
				  <tr>
				    <td align="left" valign="middle">&nbsp;</td>
				    <td align="left" valign="middle">&nbsp;</td>
				    <td align="left" valign="middle">Capital 27 777 000 DHS</td>
				    <td align="left" valign="middle">Casablanca 20290</td>
				  </tr>
				  <tr>
				    <td align="left" valign="middle">&nbsp;</td>
				    <td align="left" valign="middle">&nbsp;</td>
				    <td align="left" valign="middle">R.C Casa 38363</td>
				    <td align="left" valign="middle">T&eacute;l. +212 5 22 34 57 00</td>
				  </tr>
				  <tr>
				    <td align="left" valign="middle">&nbsp;</td>
				    <td align="left" valign="middle">&nbsp;</td>
				    <td align="left" valign="middle">CNSS 1796301</td>
				    <td align="left" valign="middle">Fax : +212 5 22 24 40 41</td>
				  </tr>
				  <tr>
				    <td align="left" valign="middle">&nbsp;</td>
				    <td align="left" valign="middle">&nbsp;</td>
				    <td align="left" valign="middle">Iden. Fiscal 1049381</td>
				    <td align="left" valign="middle">ERP@ERP.ma</td>
				  </tr>
				  <tr>
				    <td align="left" valign="middle">&nbsp;</td>
				    <td align="center" valign="middle"><font color="#000000"><strong> Page {$this->getAliasNumPage()} / {$this->getAliasNbPages()} </strong></font></td>
				    <td align="left" valign="middle">Patente 37994004</td>
				    <td align="left" valign="middle">www.ERP.ma</td>
				  </tr>
			</table>	
</font>
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