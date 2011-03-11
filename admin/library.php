<?php
//
// CheezCap - Cheezburger Custom Administration Panel
// (c) 2008 - 2010 Cheezburger Network (Pet Holdings, Inc.)
// LOL: http://cheezburger.com
// Source: http://code.google.com/p/cheezcap/
// Authors: Kyall Barrows, Toby McKes, Stefan Rusek, Scott Porad
// License: GNU General Public License, version 2 (GPL), http://www.gnu.org/licenses/gpl-2.0.html
//

class Group
{
	var $name;
	var $id;
	var $options;
	
	function Group( $_name, $_id, $_options )
	{
		$this->name = $_name;
		$this->id = "cap_" . $_id;
		$this->options = $_options;
	}
	
	function WriteHtml()
	{
		?>
            <table width="100%">
                <tr>
                    <th width="50%">Option</th>
                    <th width="50%">Value</th>
                </tr>
                <?php 
                    for( $i=0; $i < count( $this->options ); $i++ )
                    {
                        $this->options[$i]->WriteHtml();
                    }
                ?>
            </table>
		<?php 
	}
}

class Option
{
	var $name;
	var $desc;
	var $id;
    var $_key;
	var $std;
	
	function Option( $_name, $_desc, $_id, $_std )
	{
		$this->name = $_name;
		$this->desc = $_desc;
        $this->id = "cap_" . $_id;
        $this->_key = $_id;
		$this->std = $_std;
	}
	
	function WriteHtml()
	{
		echo "";
	}
	
	function Update($ignored)
	{
        $value = $_POST[$this->id];
		update_option( $this->id, $value );
	}
	
	function Reset($ignored)
	{
		update_option( $this->id, $this->std );
	}
	
	function Import($data)
    {
        if (array_key_exists($this->id, $data->dict))
            update_option( $this->id, $data->dict[$this->id] );
	}
	
	function Export($data)
    {
        $data->dict[$this->id] = get_option($this->id);
    }

    function get()
    {
        return get_option($this->id);
    }
}

class TextOption extends Option
{
    var $useTextArea;

	function TextOption( $_name, $_desc, $_id, $_std = "", $_useTextArea = false )
	{
        $this->Option( $_name, $_desc, $_id, $_std );
        $this->useTextArea = $_useTextArea;
	}
	
	function WriteHtml()
	{
		$stdText = $this->std;
		
        if ( get_option( $this->id ) != "" )
            $stdText =  get_option( $this->id );

		?><tr align="left">
					<th scope="row"><?php echo $this->name ?>:</th>
                    <?php
        $commentWidth = 2;
        if ($this->useTextArea) {
            $commentWidth = 1;
            ?><td rowspan="2"><textarea style="width:100%;height:400px;" name="<?php echo $this->id ?>" id="<?php echo $this->id ?>"><?php echo htmlspecialchars($stdText) ?></textarea><?php
        }else {
            ?><td><input name="<?php echo $this->id ?>" id="<?php echo $this->id ?>" type="text" value="<?php echo htmlspecialchars($stdText) ?>" size="40" /><?php
        }
					?></td>
				</tr>
                <tr><td colspan="<?php echo $commentWidth; ?>"><small><?php echo $this->desc ?></small></td></tr><tr><td colspan="2"><hr /></td></tr><?php 
	}

    function get()
    {
        $value = get_option($this->id);
        if (!$value)
            return $this->std;
        return $value;
    }
}

class ColorOption extends Option
{
    var $useTextArea;

	function TextOption( $_name, $_desc, $_id, $_std = "", $_useTextArea = false )
	{
        $this->Option( $_name, $_desc, $_id, $_std );
        $this->useTextArea = $_useTextArea;
	}
	
	function WriteHtml()
	{
		$stdText = $this->std;
		
        if ( get_option( $this->id ) != "" )
            $stdText =  get_option( $this->id );

		?><tr align="left">
		<th scope="row"><?php echo $this->name ?>:</th>
        	<td><input name="<?php echo $this->id ?>" id="<?php echo $this->id ?>" type="text" value="<?php echo htmlspecialchars($stdText) ?>" size="40" />
		</td>
		</tr>
                <tr><td colspan="<?php echo $commentWidth; ?>"><small><?php echo $this->desc ?></small></td></tr><tr><td colspan="2"><hr /></td></tr>
             <script type="text/javascript">
					$('#<?php echo $this->id ?>').ColorPicker({
						onSubmit: function(hsb, hex, rgb, el) {
							$(el).val(hex);
							$(el).ColorPickerHide();
						},
						onBeforeShow: function () {
							$(this).ColorPickerSetColor(this.value);
						}
					})
					.bind('keyup', function(){
						$(this).ColorPickerSetColor(this.value);
					});
			
			</script>
				<?php 
	}

    function get()
    {
        $value = get_option($this->id);
        if (!$value)
            return $this->std;
        return $value;
    }
}


class FileOption extends Option
{

	function FileOption( $_name, $_desc, $_id, $_std = "")
	{
        $this->Option( $_name, $_desc, $_id, $_std);
	}
	
	function WriteHtml()
	{
		$stdText = $this->std;
		
        if ( get_option( $this->id ) != "" )
            $stdText =  get_option( $this->id );

		?><tr align="left">
			<th scope="row"><?php echo $this->name ?>:</th>
			<td>					
			<div class="option-inputs">
				<p>
					<input class="regular-text uploaded_url" type="text" name="<?php echo $this->id ?>" value="<?php echo htmlspecialchars($stdText) ?>" /><br/><br/>
					<span id="<?php echo $this->id ?>" class="image_upload_button button">Upload Image</span>
					<span title="<?php echo $this->id ?>" id="<?php echo $this->id ?>" class="image_reset_button button">Remove</span>
					<input type="hidden" class="ajax_action_url" name="wp_ajax_action_url" value="<?php echo admin_url("admin-ajax.php"); ?>" />
					<input type="hidden" class="image_preview_size" name="img_size_<?php echo $this->id ?>" value="100"/>
				</p>
				<?php if($stdText):?>
					<img class="cc_image_preview" id="image_<?php echo $this->id ?>" src="<?php echo htmlspecialchars($stdText);  ?>" style="max-width: 100px"/>
				<?php endif;?>
			</div> 
									       
	</td>	
		</tr>
                <tr><td colspan="<?php echo $commentWidth; ?>"><small><?php echo $this->desc ?></small></td></tr><tr><td colspan="2"><hr /></td></tr><?php 
	}

    function get()
    {
        $value = get_option($this->id);
        if (!$value)
            return $this->std;
        return $value;
    }
}

class DropdownOption extends Option
{
    var $options;
    var $default;
	function DropdownOption( $_name, $_desc, $_id, $_options, $_stdIndex = 0 )
	{
		$this->Option( $_name, $_desc, $_id, $_stdIndex );
		$this->options = $_options;
	}
	
	function WriteHtml()
	{
		?>	
		<tr align="left">
			<th scope="top"><?php echo $this->name ?></th>
			<td>
				<select name="<?php echo $this->id ?>" id="<?php echo $this->id ?>">
				<?php
					foreach( $this->options as $option )
					{
						?><option<?php if ( get_option( $this->id ) == $option || (!get_option( $this->id ) && $this->options[$this->std] == $option)) {
							echo ' selected="selected"';
						}?>><?php echo $option; ?></option><?php
					}
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan=2>
				<small><?php echo $this->desc; ?></small><hr />
			</td>
		</tr><?php
	}

    function get()
    {
        $value = get_option($this->id, $this->default);
        if (strtolower($value) == 'disabled')
            return false;
        return $value;
    }
}

class BooleanOption extends DropdownOption
{
    var $default;
    function BooleanOption( $_name, $_desc, $_id, $_default = false)
    {
        $this->default = $_default;
        $this->DropdownOption($_name, $_desc, $_id, array("Disabled", "Enabled"), $_default ? 1 : 0);
    }

    function get()
    {
        $value = get_option($this->id, $this->default);
        if (is_bool($value))
            return $value;
        switch (strtolower($value)) {
            case 'true':
            case 'enable':
            case 'enabled':
                return true;
            
            default:
                return false;
        }
    }
}

// This class is the handy short cut for accessing config options
// 
// $cap->post_ratings is the same as get_bool_option("cap_post_ratings", false)
//
class autoconfig
{
    private $data = false;
    private $cache = array();

    function init()
    {
        if ($this->data)
            return;

        $this->data = array();
		$options = cap_get_options();
        foreach ($options as $group)
            foreach($group->options as $option)
            {
                $this->data[$option->_key] = $option;
            }
    }

    public function __get($name)
    {
        $this->init();

        if (array_key_exists($name, $this->cache))
            return $this->cache[$name];

        $option = $this->data[$name];
        if (!$option)
            throw new Exception("Unknown key: " . $name);
        $value = $this->cache[$name] = $option->get();
        return $value;
    }

	public function fetchConfig($fn){
		$code = '$this->' . $fn;
		eval("return $code");
	}
}

function top_level_settings()
{
    global $themename;
	
		if (isset($_REQUEST['saved']) && !empty($_REQUEST['saved'])) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
        if (isset($_REQUEST['reset']) && !empty($_REQUEST['reset'])) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
	?>
	<link rel="stylesheet" media="screen" type="text/css" href="<?php bloginfo('template_directory'); ?>/admin/css/fileuploader.css" />
	<link rel="stylesheet" media="screen" type="text/css" href="<?php bloginfo('template_directory'); ?>/admin/css/colorpicker.css" />
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/admin/js/fileuploader.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/admin/js/colorpicker.js"></script>
	<div class="wrap">
		<script type="text/javascript">
		jQuery(document).ready(function($){
			$("#config-tabs").tabs();
		});
		</script>
		<h2><b><?php echo $themename; ?> Options</b></h2>
		 <p style="margin-bottom:20px; color:#000;">Custom Community is proudly brought to you by <a style="color:#abc214" href="http://themekraft.com/" target="_blank">Themekraft</a>.
		 <br>For support, check out the <a href="http://themekraft.com/forums/" target="_blank">FORUM</a> and <a href="http://themekraft.com/faq/" target="_blank">FAQ</a>. 
		 Looking for more? <a style="color:#ff9900" href="https://themekraft.com/theme/custom-community-pro/" target="_blank">Get the Full Version</a> </p>
		<form method="post">		
            <div id="config-tabs">
			<?php 
				$groups = cap_get_options();
                print "<ul>";
				foreach( $groups as $group )
                {
                    printf("<li><a href='#%s'>%s</a></li>", $group->id, $group->name);
                }
               echo " <li><a href='#cap_getpro'>Get the Pro</a></li>";
                print "</ul>";
				foreach( $groups as $group )
                {
                    printf("<div id='%s'>", $group->id);
                    $group->WriteHtml();
                    print "</div>";
                }
				get_pro();
                ?>
         
          </div>
			<p class="submit" style='float:left'>
				<input type="hidden" name="action" value="save" />
				<input name="save" type="submit" value="Save changes" />    
			</p>
		</form>
		<form enctype="multipart/form-data" method="post">
			<p class="submit" style='float:left'>
				<input name="action" type="submit" value="Reset" />
            </p>
			<p class="submit" style='margin-left:20px; float:left'>
				<input name="action" type="submit" value="Export" />
			</p>
			<p class="submit" style='float:left'>
                <input name="action" type="submit" value="Import" />
                <input type="file" name="file" />
            </p>
        </form>
        <div style='clear:left'></div>
		<h2>Preview (updated when options are saved)</h2>
		<iframe src="../?preview=true" width="100%" height="600" ></iframe>
	<?php
}

class ImportData
{
    var $dict = array();
}

function cap_serialize_export($data)
{
    header('Content-disposition: attachment; filename=theme-export.txt');
    print serialize($data);
    exit();
}

?>