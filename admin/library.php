<?php
//
// CheezCap - Cheezburger Custom Administration Panel
// (c) 2008 - 2010 Cheezburger Network (Pet Holdings, Inc.)
// LOL: http://cheezburger.com
// Source: http://code.google.com/p/cheezcap/
// Authors: Kyall Barrows, Toby McKes, Stefan Rusek, Scott Porad
// License: GNU General Public License, version 2 (GPL), http://www.gnu.org/licenses/gpl-2.0.html
//

class Group {
	var $name;
	var $id;
	var $options;
	
	function Group( $_name, $_id, $_options ) {
		$this->name = $_name;
		$this->id = "cap_$_id";
		$this->options = $_options;
	}
	
	function WriteHtml() {
			echo '<div class="accordion">';
			for ( $i=0; $i < count( $this->options ); $i++ ) {
				$this->options[$i]->WriteHtml();
			}
			echo '</div>';
	}
}

class Option {
	var $name;
	var $desc;
	var $id;
	var $_key;
	var $std;
	var $accordion;
	var $accordion_name;
	
	function Option( $_name, $_desc, $_id, $_std  ) {
		$this->name = $_name;
		$this->desc = $_desc;
		$this->id = "cap_$_id";
		$this->_key = $_id;
		$this->std = $_std;
	}
	
	function WriteHtml() {
		echo '';
	}
	
	function Update( $ignored ) {
		$value = stripslashes_deep( $_POST[$this->id] );
		update_option( $this->id, $value );
	}
	
	function Reset( $ignored ) {
		update_option( $this->id, $this->std );
	}
	
	function Import( $data ) {
		if ( array_key_exists( $this->id, $data->dict ) )
			update_option( $this->id, $data->dict[$this->id] );
	}
	
	function Export( $data ) {
		$data->dict[$this->id] = get_option( $this->id );
	}

	function get() {
		return get_option( $this->id );
	}
}

class TextOption extends Option {
	var $useTextArea;

	function TextOption( $_name, $_desc, $_id, $_std = '', $_useTextArea = false, $_accordion = 'on', $_accordion_name = "off"  ) {
		$this->Option( $_name, $_desc, $_id, $_std );
		$this->useTextArea = $_useTextArea;
		$this->accordion = $_accordion;
		$this->accordion_name = $_accordion_name;
	}
	
	function WriteHtml() {
		$stdText = $this->std;
	
		$stdTextOption = get_option( $this->id );	
	        if ( ! empty( $stdTextOption ) )
			$stdText = $stdTextOption;

			if($this->accordion == 'on' || $this->accordion == 'start'){ ?>	
				<?php if($this->accordion_name != 'off') { ?>
					<h3><a href="#"><?php echo $this->accordion_name; ?></a></h3>
					<div>
					<p><b><?php echo $this->name; ?></b></p>
				<?php } else {?>
					<h3><a href="#"><?php echo $this->name; ?></a></h3>
					<div>
				<?php }?>
			<?php } else { ?>
				<p><b><?php echo $this->name; ?></b></p>
			<?php } ?>
			<?php echo $this->desc.'<br />'; 
			$commentWidth = 2;
			if ( $this->useTextArea ) :
				$commentWidth = 1;
				?>
				<textarea style="width:100%;height:100%;" name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>"><?php echo esc_attr( $stdText ); ?></textarea>
				<?php
			else :
				?>
				<input name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>" type="text" value="<?php echo esc_attr( $stdText ); ?>" size="40" />
				<?php
			endif; 
			
			if($this->accordion == 'on' || $this->accordion == 'end'){ ?>
				</div>
			<?php } ?>
	<?php 
	}

	function get() {
		$value = get_option( $this->id );
		if ( empty( $value ) )
			return $this->std;
		return $value;
	}
}

class DropdownOption extends Option {
	var $options;

	function DropdownOption( $_name, $_desc, $_id, $_options, $_stdIndex = 0, $_accordion = 'on', $_accordion_name = "off" ) {
		$this->Option( $_name, $_desc, $_id, $_stdIndex );
		$this->options = $_options;
		$this->accordion = $_accordion;
		$this->accordion_name = $_accordion_name;
	}
	
	function WriteHtml() {

			if($this->accordion == 'on' || $this->accordion == 'start'){ ?>	
				<?php if($this->accordion_name != 'off') { ?>
					<h3><a href="#"><?php echo $this->accordion_name; ?></a></h3>
					<div>
					<p><b><?php echo $this->name; ?></b></p>
				<?php } else {?>
					<h3><a href="#"><?php echo $this->name; ?></a></h3>
					<div>
				<?php }?>
			<?php } else { ?>
				<p><b><?php echo $this->name; ?></b></p>
			<?php } ?>
			<?php echo $this->desc.'<br />'; ?>
			<?php echo "Std: ".$this->std.'<br />'; ?>
				<select name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>">
				<?php
				
				foreach( $this->options as $option ) :
					// If standard value is given
					if( $this->std != "" ){
						?>
						<option<?php if ( get_option( $this->id ) == $option || ( ! get_option( $this->id ) && $this->options[ $this->std ] == $option )) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
						<?php
					}else{ 
						?>
						<option<?php if ( get_option( $this->id ) == $option ) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
					<?php }
				endforeach;
				?>
				</select>
			<?php if( $this->accordion == 'on' || $this->accordion == 'end'){ ?>
				</div>
			<?php } ?>
			<?php
	}

	function get() {
		$value = get_option( $this->id, $this->std );
        	if ( strtolower( $value ) == 'disabled' )
			return false;
		return $value;
	}
}

class BooleanOption extends DropdownOption {
	var $default;

	function BooleanOption( $_name, $_desc, $_id, $_default = false, $_accordion = 'on', $_accordion_name = "off"   ) {
		$this->default = $_default;
		$this->DropdownOption( $_name, $_desc, $_id, array( 'Disabled', 'Enabled' ), $_default ? 1 : 0 );
		$this->accordion = $_accordion;
		$this->accordion_name = $_accordion_name;
	}

	function get() {
		$value = get_option( $this->id, $this->default );
		if ( is_bool( $value ) )
			return $value;
		switch ( strtolower( $value ) ) {
			case 'true':
			case 'enable':
			case 'enabled':
				return true;
			default:
				return false;
		}
	}
}

class ColorOption extends Option
{

	function ColorOption( $_name, $_desc, $_id, $_std = "", $_accordion = 'on', $_accordion_name = "off"   )
	{
        $this->Option( $_name, $_desc, $_id, $_std );
        $this->accordion = $_accordion;
		$this->accordion_name = $_accordion_name;
	}
	
	function WriteHtml()
	{
		$stdText = $this->std;
		
        if ( get_option( $this->id ) != "" )
            $stdText =  get_option( $this->id );

			if($this->accordion == 'on' || $this->accordion == 'start'){ ?>	
				<?php if($this->accordion_name != 'off') { ?>
					<h3><a href="#"><?php echo $this->accordion_name; ?></a></h3>
					<div>
					<p><b><?php echo $this->name; ?></b></p>
				<?php } else {?>
					<h3><a href="#"><?php echo $this->name; ?></a></h3>
					<div>
				<?php }?>
			<?php } else { ?>
				<p><b><?php echo $this->name; ?></b></p>
			<?php } ?>
			<?php echo $this->desc.'<br />'; ?>
        	<input name="<?php echo $this->id ?>" id="<?php echo $this->id ?>" type="text" value="<?php echo htmlspecialchars($stdText) ?>" size="40" />
			<?php 
        	if($this->accordion == 'on' || $this->accordion == 'end'){ ?>
				</div>
			<?php } ?>

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

	function FileOption( $_name, $_desc, $_id, $_std = "", $_accordion = 'on', $_accordion_name = "off"  )
	{
        $this->Option( $_name, $_desc, $_id, $_std);
        $this->accordion = $_accordion;
		$this->accordion_name = $_accordion_name;
	}
	
	function WriteHtml()
	{
		$stdText = $this->std;
		
        if ( get_option( $this->id ) != "" )
            $stdText =  get_option( $this->id );
		   
			if($this->accordion == 'on' || $this->accordion == 'start'){ ?>	
				<?php if($this->accordion_name != 'off') { ?>
					<h3><a href="#"><?php echo $this->accordion_name; ?></a></h3>
					<div>
					<p><b><?php echo $this->name; ?></b></p>
				<?php } else {?>
					<h3><a href="#"><?php echo $this->name; ?></a></h3>
					<div>
				<?php }?>
			<?php } else { ?>
				<p><b><?php echo $this->name; ?></b></p>
			<?php } ?>
			<?php echo $this->desc.'<br />'; ?>
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
		<?php 	if($this->accordion == 'on' || $this->accordion == 'end'){ ?>
				</div>
			<?php } ?>
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

// This class is the handy short cut for accessing config options
// 
// $cap->post_ratings is the same as get_bool_option("cap_post_ratings", false)
//
class autoconfig {
	private $data = false;
	private $cache = array();

	function init() {
		if ( $this->data )
			return;

		$this->data = array();
		$options = cap_get_options();

		foreach ($options as $group) {
			foreach($group->options as $option) {
				$this->data[$option->_key] = $option;
			}
		}
	}

	public function __get( $name ) {
		$this->init();

		if ( array_key_exists( $name, $this->cache ) )
			return $this->cache[$name];

		$option = $this->data[$name];
		if ( empty($option) )
			throw new Exception("Unknown key: $name");

		$value = $this->cache[$name] = $option->get();
		return $value;
	}
}

function cap_admin_css() {

	wp_enqueue_style( 'colorpicker-css', get_template_directory_uri().'/admin/css/colorpicker.css', false );
	wp_enqueue_style( 'fileuploader-css', get_template_directory_uri().'/admin/css/fileuploader.css' );
	wp_enqueue_style( 'jquery-ui-css', get_template_directory_uri().'/admin/css/jquery-ui.css' );
	
}

function cap_admin_js_libs() {
	wp_deregister_script( 'jquery');
	wp_register_script( 'jquery', get_template_directory_uri() . '/admin/js/jquery-1.5.1.min.js', false, '1.5.1'); // registriere SchlŸssel jquery mit der URL von Google CDN
   	wp_enqueue_script( 'jquery' ); 

	wp_deregister_script( 'jquery-ui' );
	wp_register_script( 'jquery-ui', get_template_directory_uri() . '/admin/js/jquery-ui-1.8.11.min.js', false, '1.8.11'); // registriere SchlŸssel jquery mit der URL von Google CDN
   	wp_enqueue_script( 'jquery-ui' );	

	wp_enqueue_script( 'colorpicker-js', get_template_directory_uri()."/admin/js/colorpicker.js" );
	wp_enqueue_script( 'fileuploader-js', get_template_directory_uri()."/admin/js/fileuploader.js" );
	
}



function cap_admin_js_footer() {
?>
<script type="text/javascript">
/* <![CDATA[ */
	jQuery(document).ready(function($) {
		$("#config-tabs").tabs();
		$(".accordion").accordion({ header: "h3", active: false, autoHeight: false, collapsible:true });
	});
/* ]]> */
</script>
<?php
}

function top_level_settings() {
	global $themename;
	
	if ( isset( $_REQUEST['saved'] ) )
		echo "<div id='message' class='updated fade'><p><strong>$themename settings saved.</strong></p></div>";
	if ( isset( $_REQUEST['reset'] ) )
		echo "<div id='message' class='updated fade'><p><strong>$themename settings reset.</strong></p></div>";
	?>

	<div class="wrap">
		<h2><b><?php echo $themename; ?> Options</b></h2>
		 <p style="margin-bottom:20px; color:#000;">Custom Community is proudly brought to you by <a style="color:#abc214" href="http://themekraft.com/" target="_blank">Themekraft</a>.
		 <br>For support, check out the <a href="http://themekraft.com/forums/" target="_blank">FORUM</a> and <a href="http://themekraft.com/faq/" target="_blank">FAQ</a>. 
		 Looking for more? <a style="color:#ff9900" href="https://themekraft.com/theme/custom-community-pro/" target="_blank">Get the Full Version</a> </p>
		
		
		<form method="post">

			<div id="config-tabs">
				<ul>
	<?php 
	$groups = cap_get_options();
	foreach( $groups as $group ) :
	?>
					<li><a href='#<?php echo $group->id; ?>'><?php echo $group->name; ?></a></li>
	<?php
	endforeach;
	 echo " <li><a href='#cap_getpro'>Get the Pro</a></li>";
	?>
				</ul>
	<?php
	foreach( $groups as $group ) :
	?>
				<div id='<?php echo $group->id;?>'>
	<?php
					$group->WriteHtml();
	?>
				</div>
	<?php
	endforeach;get_pro();
	?>
			</div>
			<p class="submit alignleft">
				<input type="hidden" name="action" value="save" />
				<input name="save" type="submit" value="Save changes" />    
			</p>
		</form>
		<form enctype="multipart/form-data" method="post">
			<p class="submit alignleft">
				<input name="action" type="submit" value="Reset" />
			</p>
			<p class="submit alignleft" style='margin-left:20px'>
				<input name="action" type="submit" value="Export" />
			</p>
			<p class="submit alignleft">
				<input name="action" type="submit" value="Import" />
				<input type="file" name="file" />
			</p>
		</form>
		<div class="clear"></div>
		<h2>Preview (updated when options are saved)</h2>
		<iframe src="<?php echo home_url( '?preview=true' ); ?>" width="100%" height="600" ></iframe>
	</div>
	<?php
}

class ImportData {
	var $dict = array();
}

function cap_serialize_export( $data ) {
	header( 'Content-disposition: attachment; filename=theme-export.txt' );
	echo serialize( $data );
	exit();
}
