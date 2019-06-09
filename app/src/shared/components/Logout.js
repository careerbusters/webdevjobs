import React from "react";
export const Footer = () => (
	<div className="modal fade" id="logoutModal" tabIndex="-1" role="dialog" aria-labelledby="logoutModal"
		  aria-hidden="true">
		<div className="modal-dialog" role="document">
			<div className="modal-content">
				<div className="modal-header">
					<h5 className="modal-title" id="logoutModal">You have been logged out!</h5>
					<button type="button" className="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div className="modal-body">
					<p>Thanks for visiting. Come back soon!</p>
				</div>
			</div>
		</div>
	</div>
);