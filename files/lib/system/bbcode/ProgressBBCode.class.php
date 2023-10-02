<?php
namespace wcf\system\bbcode;
use wcf\system\WCF;
use wcf\system\exception\SystemException;
use wcf\util\StringUtil;

/**
 * ProgressBarBBCode.
 * 
 * @package	com.cls-design.wcf.progress.bbcode
 * @copyright	www.cls-design.com
 * @author	www.cls-design.com
 * @license	GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 */
final class ProgressBBCode extends AbstractBBCode {
	/**
	* @see	wcf\system\bbcode\IBBCode::getParsedTag()
	*/
	public function getParsedTag(array $openingTag, $content, array $closingTag, BBCodeParser $parser): string {

		$progress = array(
			'progressbarWidth' => (!empty($openingTag['attributes'][0])) ? StringUtil::trim($openingTag['attributes'][0]) : "",
			'legendColorscheme' => (!empty($openingTag['attributes'][1])) ? StringUtil::trim($openingTag['attributes'][1]) : "0",
		);

		$content = (!empty($content)) ? StringUtil::trim($content) : "";
		if($parser->getOutputType() == 'text/html') {
			$progressCode ='<div class="progress-bar-wrapper">';
			$progressCode .= '<div>' . $content . '</div>';
			$progressCode .= '<div class="progress-bar"><div class="progress-bar-color-scheme-'. $progress["legendColorscheme"] . '"><div style="width: '  $progress["progressbarWidth"] . '%;"> </div></div>';
			$progressCode .= '<div>' . $progress["progressbarWidth"] . '%</div></div>';
			$progressCode .= '</div>';

			return $progressCode;
		} else if($parser->getOutputType() == 'text/simplified-html') {

			return '';
		}
		return '';
	}
}