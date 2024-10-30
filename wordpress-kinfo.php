<?php
namespace kinfo;

/**
 * Plugin Name:   KINFO
 * Plugin URI:    https://gokinfo.com/widgetsinfo
 * Description:   Adds a portfolio widget to your Wordpress site
 * Version:       1.0.10
 * Author:        KINFO
 * License:       GPLv2 or later
 * Author URI:    https://gokinfo.com
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */



//add_action( 'widgets_init', 'kinfo_register_widgets' );

class kinfo_performance extends \WP_Widget
{


  // Set up the widget name and description.
    public function __construct()
    {
        $widget_options = array( 'classname' => 'performance_widget', 'description' => 'KINFO - Portfolio Performance' );
        parent::__construct( 'performance_widget', 'KINFO - Portfolio Performance', $widget_options );
    }


  // Create the widget output.
  // SideBar, Performance
    public function widget($args, $instance)
    {
        $atts = shortcode_atts(
        array(
            'profile' => 'profile',
            'account' => 'account',
            'width' => 'width',
            'period' => 'period',
            'trackingId' => 'trackingId',
        ), $atts, 'positions' );

        $profile = apply_filters( 'profile', $instance[ 'profile' ] );
        $account = apply_filters( 'account', $instance[ 'account' ] );
        $width = apply_filters( 'width', $instance[ 'width' ] );
        $period = apply_filters( 'period', $instance[ 'period' ] );
        $trackingId = apply_filters( 'trackingId', $instance[ 'trackingId' ] );

        $width = trim($width,'px');

        if ($width < 308) {
            $width=308;
        }
        $href = 'https://kinfo.app.link/zUP9aYOP4H?$desktop_url=' . urlencode('https://gokinfo.com/app/profile/' . $profile . '/account/' . $account . '/performance');
        $href = $href . '&$canonical_url=' . urlencode('https://gokinfo.com/app/profile/' . $profile . '/account/' . $account . '/performance');
        $href = $href . '&utm_campaign=Widget-SideBar-Performance';
        $href = $href . '&utm_medium=' . $profile;
        $href = $href . '&utm_source=' . $trackingId;
        $href = $href . '&refId=' . $profile;
        $href = $href . '&trackingId=' . $trackingId;
        $href = $href . '&nav=true';
        $href = $href . '&profileId=' . $profile;
        $href = $href . '&accountId=' . $account;

        ?>
        <div id="kinfo-iframe-widget-performance-<?php echo $account ?>-overlay" style="position:relative">
        <iframe id="kinfo-iframe-widget-performance-<?php echo $account ?>" src="https://gokinfo.com/app/widgets/account-performance/<?php echo $account ?>/<?php echo $period ?>/widget" frameborder="0" scrolling="no" width="<?php echo $width ?>"></iframe>        
        <a class="kinfo-portfolio-link" id="kinfo-iframe-widget-performance-<?php echo $account ?>-link" alt="View account performance on KINFO" title="View account performance on KINFO" href="<?php echo $href ?>" style="position:absolute;top:0;left:0;width:"<?php echo $width ?>"px;z-index:9999;"></a>        
        </div>        
        <?php
    }

    

  
  // Create the admin area widget settings form.
    public function form($instance)
    {
        $profile = ! empty( $instance['profile'] ) ? $instance['profile'] : '';
        $account = ! empty( $instance['account'] ) ? $instance['account'] : '';
        $width = ! empty( $instance['width'] ) ? $instance['width'] : '';
        $period = ! empty( $instance['period'] ) ? $instance['period'] : '';
        $trackingId = ! empty( $instance['trackingId'] ) ? $instance['trackingId'] : '';
        
        ?>
      <p>
        <table>
        <tr>
        <td>
          <label for="<?php echo $this->get_field_id( 'profile' ); ?>"><b>Profile ID:</b></label>
        </td><td>
          <input type="text" id="<?php echo $this->get_field_id( 'profile' ); ?>" name="<?php echo $this->get_field_name( 'profile' ); ?>" value="<?php echo esc_attr( $profile ); ?>" />
        <td>
        </tr>
        <tr>
        <td>
          <label for="<?php echo $this->get_field_id( 'account' ); ?>"><b>Account ID:</b></label>
        </td><td>
          <input type="text" id="<?php echo $this->get_field_id( 'account' ); ?>" name="<?php echo $this->get_field_name( 'account' ); ?>" value="<?php echo esc_attr( $account ); ?>" />
        <td>
        </tr>
        <tr>
        <td>
          <label for="<?php echo $this->get_field_id( 'width' ); ?>"><b>Period:</b></label>
        </td><td>
          <select id="<?php echo $this->get_field_id( 'period' ); ?>" name="<?php echo $this->get_field_name( 'period' ); ?>">
          <option value="1w" <?php echo ($period == '1w')?'selected':''; ?>>1 WEEK</option>
          <option value="1m" <?php echo ($period == '1m')?'selected':''; ?>>1 MONTH</option>
          <option value="3m" <?php echo ($period == '3m')?'selected':''; ?>>3 MONTHS</option>
          <option value="6m" <?php echo ($period == '6m')?'selected':''; ?>>6 MONTHS</option>
          <option value="1y" <?php echo ($period == '1y')?'selected':''; ?>>1 YEAR</option>          
          </select>
          </td></tr>
          </tr>
          <tr>
            <td>
            <label for="<?php echo $this->get_field_id( 'width' ); ?>"><b>Width (optional):</b></label>
            </td>
            <td>
            <input type="text" id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" value="<?php echo esc_attr( $width ); ?>" />
            </td>
          </tr>
          <tr>
            <td>
            <label for="<?php echo $this->get_field_id( 'trackingId' ); ?>"><b>Tracking Id (optional):</b></label>
            </td>
            <td>
            <input type="text" id="<?php echo $this->get_field_id( 'trackingId' ); ?>" name="<?php echo $this->get_field_name( 'trackingId' ); ?>" value="<?php echo esc_attr( $trackingId ); ?>" />
            </td>
          </tr>
          
          </table>

        </p><?php
    }

  // Apply settings to the widget instance.
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance[ 'profile' ] = sanitize_text_field( $new_instance[ 'profile' ] );
        $instance[ 'account' ] = sanitize_text_field( $new_instance[ 'account' ] );
        $instance[ 'width' ] = sanitize_text_field( $new_instance[ 'width' ] );
        $instance[ 'period' ] = sanitize_text_field( $new_instance[ 'period' ] );
        $instance[ 'trackingId' ] = sanitize_text_field( $new_instance[ 'trackingId' ] );
        return $instance;
    }
}

class kinfo_positions extends \WP_Widget
{


  // Set up the widget name and description.
  // SideBar, Positions
    public function __construct()
    {
        $widget_options = array( 'classname' => 'positions_widget', 'description' => 'KINFO - Portfolio Positions' );
        parent::__construct( 'positions_widget', 'KINFO - Portfolio Positions', $widget_options );
    }


  // Create the widget output.
    public function widget($args, $instance)
    {
        $profile = apply_filters( 'profile', $instance[ 'profile' ] );
        $account = apply_filters( 'account', $instance[ 'account' ] );
        $width = apply_filters( 'width', $instance[ 'width' ] );
        $trackingId = apply_filters( 'trackingId', $instance[ 'trackingId' ] );
        
        $width = trim($width,'px');

        if ($width < 308) {
            $width=308;
        }
        $href = 'https://kinfo.app.link/zUP9aYOP4H?$desktop_url=' . urlencode('https://gokinfo.com/app/profile/' . $profile . '/account/' . $account . '/performance');
        $href = $href . '&$canonical_url=' . urlencode('https://gokinfo.com/app/profile/' . $profile . '/account/' . $account . '/performance');
        $href = $href . '&utm_campaign=Widget-SideBar-Positions';
        $href = $href . '&utm_medium=' . $profile;
        $href = $href . '&utm_source=' . $trackingId;
        $href = $href . '&refId=' . $profile;
        $href = $href . '&trackingId=' . $trackingId;
        $href = $href . '&nav=true';
        $href = $href . '&profileId=' . $profile;
        $href = $href . '&accountId=' . $account;


        
        ?>
        <div id="kinfo-iframe-widget-positions-<?php echo $account ?>-overlay" style="position:relative">
        <iframe id="kinfo-iframe-widget-positions-<?php echo $account ?>" src="https://gokinfo.com/app/widgets/account-positions/<?php echo $account ?>/widget" frameborder="0" scrolling="no" width="<?php echo $width ?>"></iframe>        
        <a class="kinfo-portfolio-link" id="kinfo-iframe-widget-positions-<?php echo $account ?>-link" alt="View account positions on KINFO" title="View account positions on KINFO" href="<?php echo $href ?>" style="position:absolute;top:0;left:0;width:<?php echo $width ?>px;z-index:9999;"></a>        
        </div>

        
        <?php
    }

    
  
  // Create the admin area widget settings form.
    public function form($instance)
    {
        $profile = ! empty( $instance['profile'] ) ? $instance['profile'] : '';
        $account = ! empty( $instance['account'] ) ? $instance['account'] : '';
        $width = ! empty( $instance['width'] ) ? $instance['width'] : ''; 
        $trackingId = ! empty( $instance['trackingId'] ) ? $instance['trackingId'] : ''; 
        ?>
        
      <p>
        <table>
        <tr>
        <td>
          <label for="<?php echo $this->get_field_id( 'profile' ); ?>"><b>Profile ID:</b></label>
        </td><td>
          <input type="text" id="<?php echo $this->get_field_id( 'profile' ); ?>" name="<?php echo $this->get_field_name( 'profile' ); ?>" value="<?php echo esc_attr( $profile ); ?>" />
        <td>
        </tr>

        <tr>
        <td>
          <label for="<?php echo $this->get_field_id( 'account' ); ?>"><b>Account ID:</b></label>
        </td><td>
          <input type="text" id="<?php echo $this->get_field_id( 'account' ); ?>" name="<?php echo $this->get_field_name( 'account' ); ?>" value="<?php echo esc_attr( $account ); ?>" />
        <td>
        </tr>
        <tr>
          <td>
          <label for="<?php echo $this->get_field_id( 'width' ); ?>"><b>Width (optional):</b></label>
        </td><td>
          <input type="text" id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" value="<?php echo esc_attr( $width ); ?>" />
          </td>
        </tr>
        <tr>
          <td>
          <label for="<?php echo $this->get_field_id( 'trackingId' ); ?>"><b>Tracking Id (optional):</b></label>
        </td><td>
          <input type="text" id="<?php echo $this->get_field_id( 'trackingId' ); ?>" name="<?php echo $this->get_field_name( 'trackingId' ); ?>" value="<?php echo esc_attr( $trackingId ); ?>" />
          </td>
        </tr>
          
          </table>
        </p><?php
    }


  // Apply settings to the widget instance.
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance[ 'profile' ] = sanitize_text_field( $new_instance[ 'profile' ] );
        $instance[ 'account' ] = sanitize_text_field( $new_instance[ 'account' ] );
        $instance[ 'width' ] = sanitize_text_field( $new_instance[ 'width' ] );
        $instance[ 'trackingId' ] = sanitize_text_field( $new_instance[ 'trackingId' ] );
        return $instance;
    }
}

// ShortCode, Performance
function kinfo_shortCode_performance($atts)
{
        $profile = $atts['profile'];
        $account = $atts['account'];
        $width = $atts['width'];
        $period  = $atts['period'];
        $trackingId  = $atts['trackingId'];
        $href = $href . '&nav=true';
        $href = $href . '&profileId=' . $profile;
        $href = $href . '&accountId=' . $account;
        
        $width = trim($width,'px');

    if ($width < 308) {
        $width=308;
    }

    $href = 'https://kinfo.app.link/zUP9aYOP4H?$desktop_url=' . urlencode('https://gokinfo.com/app/profile/' . $profile . '/account/' . $account . '/performance');
    $href = $href . '&$canonical_url=' . urlencode('https://gokinfo.com/app/profile/' . $profile . '/account/' . $account . '/performance');
    $href = $href . '&utm_campaign=Widget-ShortCode-Performance';
    $href = $href . '&utm_medium=' . $profile;
    $href = $href . '&utm_source=' . $trackingId;
    $href = $href . '&refId=' . $profile;
    $href = $href . '&trackingId=' . $trackingId;
    $href = $href . '&nav=true';
    $href = $href . '&profileId=' . $profile;
    $href = $href . '&accountId=' . $account;


    $frame = '<div id="kinfo-iframe-shortcode-performance-' . $account . '-overlay" style="position:relative">';
    $frame = $frame . '<iframe id="kinfo-iframe-shortcode-performance-' . $account . '" src="https://gokinfo.com/app/widgets/account-performance/' .$account . '/' . $period . '/shortCode" frameborder="0" scrolling="no" width="' .$width . '"></iframe>';
    $frame = $frame . '<a class="kinfo-portfolio-link" id="kinfo-iframe-shortcode-performance-' . $account .'-link" alt="View account performance on KINFO" title="View account performance on KINFO" href="' . $href .'" style="position:absolute;top:0;left:0;width:' . $width . 'px;z-index:9999;"></a>';
    return $frame;
    //return '<iframe id="kinfo-iframe-performance-' . $account . '" src="https://gokinfo.com/app/widgets/account-performance/' .$account . '/' . $period . '" frameborder="0" scrolling="no" width="' .$width . '"></iframe>';
}

// ShortCode, Positions
function kinfo_shortCode_positions($atts)
{
        $atts = shortcode_atts(
        array(
            'profile' => 'profile',
            'account' => 'account',
            'width' => 'width',
            'trackingId' => 'trackingId',
        ), $atts, 'positions' );

        $profile = $atts['profile'];
        $account = $atts['account'];
        $width = $atts['width'];
        $trackingId = $atts['trackingId'];

        $width = trim($width,'px');

    if ($width < 308) {
        $width=308;
    }

    $href = 'https://kinfo.app.link/zUP9aYOP4H?$desktop_url=' . urlencode('https://gokinfo.com/app/profile/' . $profile . '/account/' . $account . '/performance');
    $href = $href . '&$canonical_url=' . urlencode('https://gokinfo.com/app/profile/' . $profile . '/account/' . $account . '/performance');
    $href = $href . '&utm_campaign=Widget-SideBar-Positions';
    $href = $href . '&utm_medium=' . $profile;
    $href = $href . '&utm_source=' . $trackingId;
    $href = $href . '&refId=' . $profile;
    $href = $href . '&trackingId=' . $trackingId;
    $href = $href . '&nav=true';
    $href = $href . '&profileId=' . $profile;
    $href = $href . '&accountId=' . $account;

        
        
    $frame = '<div id="kinfo-iframe-shortcode-positions-' . $account . '-overlay" style="position:relative">';
    $frame = $frame . '<iframe id="kinfo-iframe-shortcode-positions-' . $account . '" src="https://gokinfo.com/app/widgets/account-positions/' .$account . '/shortCode" frameborder="0" scrolling="no" width="' .$width . '"></iframe>';
    $frame = $frame .  '<a class="kinfo-portfolio-link" id="kinfo-iframe-shortcode-positions-' . $account .'-link" alt="View account positions on KINFO" title="View account positions on KINFO" href="' . $href . '" style="position:absolute;top:0;left:0;width:' . $width .'px;z-index:9999;"></a>';
    return $frame;
}



// Register the widget.
function kinfo_register_widgets()
{
    register_widget( 'kinfo\kinfo_performance' );
    register_widget( 'kinfo\kinfo_positions' );
    //register_widget(new kinfo\kinfo_performance );
    //register_widget(new kinfo\kinfo_positions );
}

function kinfo_register_js()
{
    wp_register_style( 'kinfo-css', plugins_url( '/css/kinfo-1.0.10.css', __FILE__ ), array(), '2017112901', 'all' );
    wp_enqueue_style( 'kinfo-css' );
    wp_enqueue_script( 'kinfo-js', plugins_url( '/js/kinfo-1.0.10.js', __FILE__ ));
}


function kinfo_install()
{
    // Nothing to do here yet
}
function kinfo_uninstall()
{
    // Nothing to do here yet
}
function kinfo_deactivation()
{
    // Nothing to do here yet
}

add_action('wp_enqueue_scripts', 'kinfo\kinfo_register_js');
add_action( 'widgets_init', 'kinfo\kinfo_register_widgets' );
add_shortcode('kinfo-performance', 'kinfo\kinfo_shortCode_performance');
add_shortcode('kinfo-positions', 'kinfo\kinfo_shortCode_positions');
register_deactivation_hook( __FILE__, 'kinfo\kinfo_deactivation' );
register_activation_hook( __FILE__, 'kinfo\kinfo_install' );
register_uninstall_hook(__FILE__, 'kinfo\kinfo_uninstall');

?>
