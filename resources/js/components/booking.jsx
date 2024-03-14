import React, { Component } from 'react';
import { createRoot } from 'react-dom/client';
import axios from "axios";

class Booking extends Component {
    constructor(props) {
        super(props);
        this.state = {
            date: new Date().toISOString().slice(0, 10),
            patient_id: '',
            doctor_id: '',
            message: '',
            time: new Date().toISOString().slice(11, 16),
            payment_mode: '',
            errors: {},
            data: [],
            docdata: [],
        };
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

    loadChange = async (selectedValue) => {
        try {
            const response = await axios.get(`/whms/department/${selectedValue}`);
            this.setState({ docdata: response.data });
        } catch (error) {
            console.error('Error fetching department data:', error);
        }
    };

    handleChange = (e) => {
        this.setState({
            [e.target.name]: e.target.value
        });
    }

    handleSubmit = (e) => {
        e.preventDefault();
        const booking = {
            date: this.state.date,
            doctor_id: this.state.doctor_id,
            time: `${this.state.date} ${this.state.time}:00`,
            description: this.state.message,
            payment_mode: this.state.payment_mode
        };
        console.log(booking);

        const formData = new FormData();
        for (const key in booking) {
            formData.append(key, booking[key]);
        }
        console.log(formData.getAll('doctor_id'))
        axios.post("/whms/booking", formData)
            .then(response => {
                console.log(response);
            })
            .catch(error => {
                console.log(error);
            });
    }

    render() {
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
                            onChange={(e) => this.loadChange(e.target.value)}>
                            <option value="">Select Department</option>
                            {this.state.data.map(element => (
                                <option key={element.id} value={element.id}>{element.name}</option>
                            ))}
                        </select>
                    </div>
                    <div className="form-group">
                        <label htmlFor="Doctor">Doctor</label>
                        <select
                            className="form-control"
                            id="doctor"
                            name="doctor_id"
                            value={this.state.doctor}
                            onChange={this.handleChange}>
                            <option value="">Select Doctor</option>
                            {this.state.docdata.map(element => (
                                <option key={element.id} value={element.id}>{element.users[0]?.username}</option>
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
                            required
                        />
                    </div>
                    <div className="form-group">
                        <label htmlFor="message">Message</label>
                        <textarea
                            className="form-control"
                            id="message"
                            name="message"
                            value={this.state.message}
                            onChange={this.handleChange}
                            required
                        />
                    </div>

                    <div className="form-group">
                        <label htmlFor="payment_mode">Payment Mode</label>
                        <select
                            className="form-control"
                            id="payment_mode"
                            name="payment_mode"
                            value={this.state.payment_mode}
                            onChange={this.handleChange} required >
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
    }
}

if (document.getElementById('bk_appnmt')) {
    const container = document.getElementById('bk_appnmt');
    const root = createRoot(container);
    root.render(<Booking />);
}
