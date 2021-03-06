<?php
/**
 * "Projects" page.
 *
 * @author Timo Tijhof, 2012
 * @since 0.3.0
 * @package TestSwarm
 */

class ProjectsPage extends Page {

	public function execute() {
		$action = ProjectsAction::newFromContext( $this->getContext() );
		$action->doAction();

		$this->setAction( $action );
		$this->content = $this->initContent();
	}

	protected function initContent() {
		$this->setTitle( "Projects" );

		$projects = $this->getAction()->getData();

		$html = '<blockquote><p>Below is an overview of all registered projects,'
			. ' sorted alphabetically by name.</p></blockquote>'
			. '<table class="table table-striped">'
			. '<thead><tr><th>Project name</th><th class="span2">Jobs</th><th class="span4">Creation date</th></tr></thead>'
			. '<tbody>';

		foreach ( $projects as $project ) {
			$html .= '<tr>'
				. '<td><a href="' . htmlspecialchars( swarmpath( "user/{$project["name"]}" ) ) . '">' . htmlspecialchars( $project["name"] ) . '</a></td>'
				. '<td class="num">' . htmlspecialchars( number_format( $project["jobCount"] ) ) . '</td>'
				. '<td class="num"><span title="'
					. htmlspecialchars( $project["createdISO"] ) . '" class="pretty">'
					. htmlspecialchars( $project["createdLocalFormatted"] ) . '</span></td>'
				. '</tr>';
		}
		$html .= '</tbody></table>';

		return $html;
	}

}
