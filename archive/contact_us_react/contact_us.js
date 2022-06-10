import React, {useState} from "react";
import "./contact_us.css";



export default function App() {

    const [values,setValues] = usestate({
        firstname: "",
        lastname: "",
        email: "",
    });

    const [submitted,setsubmitted]=useState(false);
    const [valid,setvalid] = useState(false);

    const handledfirstnameinputchange = (event) =>{
        setValues({...values,firstname: event.target.value})
    }

    const handledlastnameinputchange = (event) =>{
        setValues({...event.values,lastname: event.target.value})
    }

    const handledemailinputchange = (event) =>{
        setValues({...values,email: event.target.value})
    }

    const hanldesumbit = (event) => {
        event.preventDefault();
        if(values.firstname && values.lastname && values.email){
            setvalid(true);
        }
        setsubmitted(true);
    }

  return (
    <div class="form-container">
      <form class="register-form" onsubmit={hanldesumbit}>
        {submitted ?  <div class="success-message">Success! Thank you for registering</div> : null}
        <input
          onchange={handledfirstnameinputchange}
          value={values.firstname}
          id="first-name"
          class="form-field"
          type="text"
          placeholder="First Name"
          name="firstName"
        />
        {submitted && !values.firstname ? <span id="first-name-error">Please enter a first name</span> : null}
        <input
          onchange={handledlastnameinputchange}
          value={values.lastname}
          id="last-name"
          class="form-field"
          type="text"
          placeholder="Last Name"
          name="lastName"
        />
        {submitted && !values.lastname ? <span id="last-name-error">Please enter a last name</span> : null}
        <input
          onchange={handledemailinputchange}
          value={values.email}
          id="email"
          class="form-field"
          type="text"
          placeholder="Email"
          name="email"
        />
        {submitted && !values.email ? <span id="email-name-error">Please enter an email </span> : null}
        <button class="form-field" type="submit">
          Register
        </button>
      </form>
    </div>
  );
}
