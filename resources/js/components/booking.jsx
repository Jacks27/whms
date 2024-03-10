import React from "react";
import { createRoot } from 'react-dom/client';
import axios from "axios";

class Booking extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            date: new Date(),
            patient_id:'',
            doctor_id:'',
            time:'',
            payment_mode:'',
            errors: {},
            data: [],
        };
        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
        this.loadDct = this.loadDct.bind(this);
    }

    componentDidMount() {
        axios.get("whms/department").then(response => {
            this.setState({
                data: response.data
            });
        });
    }

    loadDct(e) {
        const dept_id = e.target.value;
        axios.get("whms/department/"+dept_id).then(response => {
            this.setState({
                docdata: response.data
            });
        });
    }

    render(){
        return (
            <div>
                <form onSubmit={this.handleSubmit}>
                    <div className="form-group">
                        <label htmlFor="date">Appoint </label>
                        <select
                            className="form-control"
                            id="department"
                            name="department"
                            value={this.state.department}
                            onChange={this.handleChange} >
                            <option value="">Select Department</option>
                            {this.state.data.map(elmen => {
                                return <option key={elmen.id} onClick={this.loadDct} value={elmen.id}>{elmen.name}</option>;
                            })}
                        </select>

                    </div>
                    <div className="form-group">
                        <label htmlFor="Doctor">Doctor</label>
                        <select
                            className="form-control"
                            id="doctor"
                            name="doctor"
                            value={this.state.doctor}
                            onChange={this.handleChange} >
                            <option value="">Select Doctor</option>
                            {this.state.docdata && this.state.docdata.map(elmen => {
                                return <option key={elmen.id} value={elmen.id}>{elmen.name}</option>;
                            })}
                            </select>
                    </div>
                    {/* the doctor options will be filled from the loaddoctors function  */}
                    {/* ... rest of the form fields ... */}
                </form>
            </div>
        );
    };

    handleChange(e) {
        this.setState({
            [e.target.name]: e.target.value
        });
    }

    handleSubmit(e) {
        e.preventDefault();
        const booking = {
            date: this.state.date,
            patient_id: this.state.patient_id,
            doctor_id: this.state.doctor_id,
            time: this.state.time,
            payment_mode: this.state.payment_mode
        };
        axios
            .post("http://localhost:8000/api/bookings", booking)
            .then(response => {
                console.log(response);
            })
            .catch(error => {
                console.log(error);
            });
    }

}

if (document.getElementById('bk_appnmt')) {
    const container = document.getElementById('bk_appnmt');
    const root = createRoot(container);
    root.render(<Booking />);
}
