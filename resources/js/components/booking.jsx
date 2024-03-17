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
            isUpdating: false, // Flag to determine if we're updating or posting
            updateId: null // To store the ID of the record being updated
        };
    }

    componentDidMount() {
        this.fetchData();
    }

    fetchData = async () => {
        try {
            const response = await axios.get('/whms/department');
            this.setState({ data: response.data });
            if (window.location.pathname.includes('edit')) {
                // If the URL contains 'update', we're updating
                this.setState({ isUpdating: true });
                // Fetch the data for the record being updated
                const id = window.location.pathname.split('/').pop();
                const response = await axios.get(`/whms/booking/${id}/edit`);
                const { date, doctor_id, time, description, payment_mode } = response.data[0];

                this.setState({ updateId: response.data.id, doctor_id: response.data.doctor_id,
                                message: response.data.description, payment_mode: response.data.payment_mode });

                console.log(this.state.message);
                this.setState({ doctor_id,message: description, payment_mode });

            }

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
        const { isUpdating } = this.state;

        const booking = {
            date: this.state.date,
            doctor_id: this.state.doctor_id,
            time: `${this.state.date} ${this.state.time}:00`,
            description: this.state.message,
            payment_mode: this.state.payment_mode
        };

        const formData = new FormData();

        for (const key in booking) {
            formData.append(key, booking[key]);
        }

        if (isUpdating) {
            // If updating, send a PUT request instead of POST
            const id = window.location.pathname.split('/')[3]

            axios.put(`/whms/booking/${id}`, formData)
                .then(response => {
                    console.log(response);
                })
                .catch(error => {
                    this.state.errors=error
                    console.log(error.response.data);
                    this.setState({ errors: error.response.data });
                });
        } else {
            // If not updating, send a POST request
            axios.post("/whms/booking", formData)
                .then(response => {
                    console.log(response);
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }

    handleUpdate = (id) => {
        // Set the state to indicate we're updating and store the ID of the record
        this.setState({
            isUpdating: true,
            updateId: id
        });

        // You may want to fetch the data for the record being updated here and pre-fill the form
    }

    render() {

        return (
            <div>
            <div className='text-danger'> {this.state.errors.message} {this.state.errors.errors?.doctor_id}</div>
                <form onSubmit={this.handleSubmit}>
                <div className="form-group">
                        <label htmlFor="date">Appoint </label>
                        <select
                            className="form-control"
                            id="department"
                            name="department"
                            c
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
                            className='form-control {{ this.state.errors.erros->has("doctor_id") ? " is-invalid" : ""}}'
                            id="doctor"
                            name="doctor_id"
                            value={this.state.doctor}
                            onChange={this.handleChange}>
                            <option value="">Select Doctor</option>
                            {this.state.docdata.map(element => (
                                <option key={element.id} value={element.id}>{element.users[0]?.username}</option>
                            ))}
                        </select>
                        <div className='text-danger'><strong> {this.state.errors.errors?.doctor_id}</strong> </div>

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
                   <div className='text-danger'><strong> {this.state.errors.errors?.date}</strong> </div>

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
                    <div className='text-danger'><strong> {this.state.errors.errors?.time}</strong> </div>

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
                    <div className='text-danger'><strong> {this.state.errors.errors?.description}</strong> </div>

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
                    <div className='text-danger'><strong> {this.state.errors.errors?.payment_mode}</strong> </div>

                    <button type="submit" className="btn btn-primary">
                        {this.state.isUpdating ? 'Update' : 'Book'} {/* Change button text based on mode */}
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
