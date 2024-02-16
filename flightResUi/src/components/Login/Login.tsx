import Button from "react-bootstrap/Button";
import Form from "react-bootstrap/Form";
import "../../assets/css/loginAndRegister.css"

function BasicExample() {
  return (
    <div className="full-page-container">
      <div className="centered-form-container">
        <h1 className="title">Log in</h1>
        <Form>
          <Form.Group className="mb-3">
            <Form.Control
              type="email"
              placeholder="Email"
            />
          </Form.Group>
          <Form.Group className="mb-3">
            <Form.Control
              type="password"
              placeholder="Password"
            />
          </Form.Group>
          <Button variant="primary" type="submit">
            Login
          </Button>
        </Form>
      </div>
    </div>
  );
}

export default BasicExample;