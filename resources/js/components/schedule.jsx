import React, { Component } from 'react';
import { createRoot } from 'react-dom/client';
import axios from "axios";
import './css/utilspage.css';
import  AppntSearchInput from './searchdoctor';

class Booking extends Component {
    constructor(props) {
        super(props);
        this.state = {

            doctor_id: '',
            appointment_id: '',
            report: '',
            prescription: '',
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
    handleCallback = (id) => {
        this.setState({ data: id });
        console.log(id);
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
                <div className="container">
                        <label htmlFor="date">Appoint </label>

                        <AppntSearchInput SearchInputCb={this.handleCallback}  />
                    </div>
                    <table className='table table-bordered mt-2'>
                        <thead>
                            <tr>
                                <th>Doctor</th>
                                <th>Time</th>
                                <th>Department</th>
                            </tr>
                        </thead>
                        <tbody>
                            {this.state.data.map((item) => (
                                <tr key={item.id}>
                                    <td>{item.username}</td>
                                    <td>{item.time}</td>
                                    <td>{item.department}</td>
                                </tr>
                            ))}
                        </tbody>
                    </table>


</div>
        );

    }
}

if (document.getElementById('schedule_app')) {
    const container = document.getElementById('schedule_app');
    const root = createRoot(container);
    root.render(<Booking />);
}
