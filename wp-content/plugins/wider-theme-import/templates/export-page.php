<?php
/**
 * @since: 1.0.0
 * @author: Wider-Themes
 * @create: 16-Nov-17
 */
?>
<div class="evolt-export-demos">
    <h3><?php echo esc_html__('Export', CTI_TEXT_DOMAIN) ?></h3>
    <form method="post" class="evolt-export-contents">
        <div class="evolt-export-name">
            <input required='' type="text" id="evolt-ie-id" name="evolt-ie-id" placeholder='<?php echo esc_html__('Name', CTI_TEXT_DOMAIN) ?>'>
        </div>
        <div class="evolt-export-link">
            <input required='' type="text" id="evolt-ie-link" name="evolt-ie-link" placeholder='<?php echo esc_html__('Demo Link', CTI_TEXT_DOMAIN) ?>'>
        </div>
        <div class="evolt-export-options">
            <h4><?php echo esc_html__('Select data:', CTI_TEXT_DOMAIN) ?></h4>
            <div class="evolt-export-list-opt">
                <div class="evolt-checkbox-wrap">
                    <div class="evolt-checkbox">
                        <input id="evolt-ie-data-media" name="evolt-ie-data-type[]" type="checkbox" value="attachment" checked="checked">
                        <span></span>
                        <label for="evolt-ie-data-media"><?php esc_html_e('Media', CTI_TEXT_DOMAIN); ?></label>
                    </div>
                </div>
                <div class="evolt-checkbox-wrap">
                    <div class="evolt-checkbox">
                        <input id="evolt-ie-data-widget" name="evolt-ie-data-type[]" type="checkbox" value="widgets"
                               checked="checked">
                        <span></span>
                        <label for="evolt-ie-data-widget"><?php esc_html_e('Widgets', CTI_TEXT_DOMAIN); ?></label>
                    </div>
                </div>
                <div class="evolt-checkbox-wrap">
                    <div class="evolt-checkbox">
                        <input id="evolt-ie-data-setting" name="evolt-ie-data-type[]" type="checkbox" value="options"
                               checked="checked">
                        <span></span>
                        <label for="evolt-ie-data-setting"><?php esc_html_e('WP Settings', CTI_TEXT_DOMAIN); ?></label>
                    </div>
                </div>
                <?php if (class_exists('ReduxFramework')): ?>
                    <div class="evolt-checkbox-wrap">
                        <div class="evolt-checkbox">
                            <input id="evolt-ie-data-option" name="evolt-ie-data-type[]" type="checkbox" value="settings"
                                   checked="checked">
                            <span></span>
                            <label for="evolt-ie-data-option"><?php esc_html_e('Theme Options', CTI_TEXT_DOMAIN); ?></label>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (function_exists('cptui_get_post_type_data')): ?>
                    <div class="evolt-checkbox-wrap">
                        <div class="evolt-checkbox">
                            <input id="evolt-ie-data-posttype" name="evolt-ie-data-type[]" type="checkbox" value="ctp_ui"
                                   checked="checked">
                            <span></span>
                            <label for="evolt-ie-data-posttype"><?php esc_html_e('Post Type', CTI_TEXT_DOMAIN); ?></label>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="evolt-checkbox-wrap">
                    <div class="evolt-checkbox">
                        <input id="evolt-ie-data-content" name="evolt-ie-data-type[]" type="checkbox" value="content"
                               checked="checked">
                        <span></span>
                        <label for="evolt-ie-data-content"><?php esc_html_e('Content', CTI_TEXT_DOMAIN); ?></label>
                    </div>
                </div>
                <?php if (class_exists('RevSlider')): ?>
                    <div class="evolt-checkbox-wrap">
                        <div class="evolt-checkbox">
                            <input id="evolt-ie-data-rev" name="evolt-ie-data-type[]" type="checkbox" value="revslider"
                                   checked="checked">
                            <span></span>
                            <label for="evolt-ie-data-rev"><?php esc_html_e('Slider Revolution', CTI_TEXT_DOMAIN); ?></label>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="evolt-export-btn">
            <input type="hidden" name="action" value="evolt-export">
            <button type="submit"
                    class="button button-primary create-demo"><?php esc_html_e('Create Demo', CTI_TEXT_DOMAIN); ?></button>
            <button type="submit" class="button button-primary download-demo" name="evolt-ie-download"
                    value="swa"><?php esc_html_e('Download All Demos', CTI_TEXT_DOMAIN); ?></button>
        </div>
    </form>
</div>
