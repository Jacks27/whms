import React, { Component, useEffect } from "react";
import ReactDOM from "react-dom";
import axios from "axios";
import { createRoot } from 'react-dom/client';

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
        useEffect(() => {
            axios.get("whms/department").then(response => {
                this.setState({
                    data: response.data
                });
            });
        }
        , []);

    } // Add closing parenthesis here

    render(){
        const{data}=this.state
        return (
            <div>
                <form onSubmit={this.handleSubmit}>
                    <div className="form-group">
                        <label htmlFor="date">Department</label>
                        <select
                            className="form-control"
                            id="department"
                            name="department"
                            value={this.state.department}
                            onChange={this.handleChange} >
                            <option value="">Select Department</option>
                            {this.state.data.map(elmen => {
                                return <option key={elmen.id} value={elmen.id}>{elmen.name}</option>;
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
                            {this.state.docdata.map(elmen => {
                                return <option key={elmen.id} value={elmen.id}>{elmen.name}</option>;
                            })}
                            </select>
                    </div>
                            {/* the doctor options will be filled from the loaddoctors funtion  */}
                    <div className="form-group">
                        <label htmlFor="date">Date</label>
                        <input
                            type="date"
                            className="form-control"
                            id="date"
                            name="date"
                            value={this.state.date}
                            onChange={this.handleChange}
                        />
                    </div>
                    <div className="form-group">
                        <label htmlFor="patient_id">Patient ID</label>
                        <input
                            type="text"
                            className="form-control"
                            id="patient_id"
                            name="patient_id"
                            value={this.state.patient_id}
                            onChange={this.handleChange}
                        />
                    </div>
                    <div className="form-group">
                        <label htmlFor="doctor_id">Doctor ID</label>
                        <input
                            type="text"
                            className="form-control"
                            id="doctor_id"
                            name="doctor_id"
                            value={this.state.doctor_id}
                            onChange={this.handleChange}
                        />
                    </div>
                    <div className="form-group">
                        <label htmlFor="time">Time</label>
                        <input
                            type="time"
                            className="form-control"
                            id="time"
                            name="time"
                            value={this.state.time}
                            onChange={this.handleChange}
                        />
                    </div>
                    <div className="form-group">
                        <label htmlFor="payment_mode">Payment Mode</label>
                        <input
                            type="text"
                            className="form-control"
                            id="payment_mode"
                            name="payment_mode"
                            value={this.state.payment_mode}
                            onChange={this.handleChange}
                        />
                    </div>
                    <button type="submit" className="btn btn-primary">
                        Submit
                    </button>
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
