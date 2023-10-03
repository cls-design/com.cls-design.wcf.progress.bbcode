<?php

namespace wcf\system\bbcode;

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
		$progressbarWidth = (int) ($openingTag['attributes'][0] ?? 0);
		$progressColorscheme = StringUtil::trim($openingTag['attributes'][1] ?? 'default');
		$content = MessageUtil::stripCrap(StringUtil::trim($content));
		
		if ($parser->getOutputType() == 'text/html') {
			$contentWrapper = '' === $content ? '' : "<div>{$content}</div>";
			
			return <<<HTML
			<div class="progress-bar-wrapper">
				{$contentWrapper}
				<div class="progress-bar">
					<div class="progress-bar-color-scheme-{$progressColorscheme}">
						<div style="width: {$progressbarWidth}%;"></div>
					</div>
					<div>{$progressbarWidth}%</div>
				</div>
			</div>
			HTML;
		}
		
		return '';
	}
}