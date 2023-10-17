<?php

namespace wcf\system\bbcode;
use wcf\system\WCF;
use wcf\util\MessageUtil;
use wcf\util\StringUtil;

/**
 * ProgressBBCode.
 * 
 * @package		com.cls-design.wcf.progress.bbcode
 * @copyright	www.cls-design.com
 * @author		www.cls-design.com
 * @license	GNU Lesser General Public License <http://opensource.org/licenses/lgpl-license.php>
 */
final class ProgressBBCode extends AbstractBBCode {
	/**
	 * @inheriDoc
	 */
	public function getParsedTag(array $openingTag, $content, array $closingTag, BBCodeParser $parser) : string {
		$progressbarWidth = (int) ($openingTag['attributes'][0] ?? '0');
		$progressColorscheme = (int) ($openingTag['attributes'][1] ?? '0');
		$content = MessageUtil::stripCrap(StringUtil::trim($content));
		$progressTitle = WCF::getLanguage()->get('wcf.bbcode.progress');

		if ($parser->getOutputType() == 'text/html') {
			return <<<HTML
			<div class="progress-bar-wrapper progress-bar-color-scheme-{$progressColorscheme}">
				{$content}
				<div class="progress-bar">
					<progress min="0" max="100"  value="{$progressbarWidth}"></progress>
					<div>{$progressbarWidth}%</div>
				</div>
			</div>
			HTML;
		} elseif ($parser->getOutputType() == 'text/simplified-html') {
			return '<div class="progress-bar-wrapper">'. $progressTitle . ' ' . $content . ': ' . $progressbarWidth . '%</div>';
		} else {
		 	return $progressTitle . ' ' . $content . ': ' . $progressbarWidth;
		}

		return '';
	}
}