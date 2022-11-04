import { render } from "@testing-library/react";
import DeactivateModal from "../index";

describe('asdf', () => {
	it('yo2', () => {
		render( <DeactivateModal apiUrl='asdf.com' pageData={ {'domain': 'foo.com'} } isEvent={ () => true } /> );
	});
});
