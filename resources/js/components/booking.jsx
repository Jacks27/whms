import React, { useState, useEffect } from 'react';
import { createRoot } from 'react-dom/client';
import axios from "axios";

class Booking extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            date: new Date().toISOString().slice(0, 10),
            patient_id:'',
            doctor_id:'',
            time: new Date().toISOString().slice(11, 16),
            payment_mode:'',
            errors: {},
            data: [],
            docdata: [],
        };
        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
        this.loadDct = this.loadDct.bind(this);
    }

    componentDidMount() {
       this.fetchData();
    }

    fetchData = async () => {
        try {
            const response = await axios.get('/whms/department');
            this.setState({ data: response.data });

        } catch (error) {
            this.setState({ error: 'An error occurred while fetching data.' });
        }
    }


loadDct(e) {
    console.log('item clicked');
    const dept_id = e.target.value;

}
loadChange = () => {
    var selectBox = document.getElementById("department");
    var selectedValue = selectBox.value;
    this.setState({ docdata: [] });
    document.getElementById("doctor").value = "";


    axios.get(`/whms/department/${selectedValue}`)
        .then(response => {
        this.setState({ docdata: response.data });
        console.log(response.data);

        })
        .catch(error => {
            console.error('Error fetching department data:', error);
        });
};


    render(){
        // this.state = {patient_id:'', doctor_id:'', time: new Date().toISOString().slice(11, 16), payment_mode:'', errors: {}};
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
                            onChange={this.loadChange} >
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
{this.state.docdata && this.state.docdata.map(element => (
    <option key={element.id} value={element.id}> {element.users[0]?.username}</option>
))}
                            </select>
                    </div>
                    <div className="form-group">
                        <label htmlFor="date">Date</label>
                        <input
                        type="date"
                        className="form-control"
                        id="date"
                        name="date"
                        min={new Date().toISOString().slice(0, 10)}
                        value={this.state.date}
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
                            format='HH:mm'
                            min="09:00"
                            max="18:00"
                            value={this.state.time}
                            onChange={this.handleChange}
                        />
                    </div>
                    <div className="form-group">
                        <label htmlFor="payment_mode">Payment Mode</label>
                        <select
                            className="form-control"
                            id="payment_mode"
                            name="payment_mode"
                            value={this.state.payment_mode}
                            onChange={this.handleChange} >
                            <option value="">Select Payment Mode</option>
                            <option value="Cash">Cash</option>
                            <option value="Mpesa">Mpesa</option>
                        </select>
                    </div>
                    <button type="submit" className="btn btn-primary">
                        Book
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
