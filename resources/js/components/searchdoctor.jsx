import React from 'react';
import './css/utilspage.css';




class AppntSearchInput extends React.Component{
    constructor(props) {
      super(props);
      this.state = {
        searchTerm: '',
        data: [],
        doctor_id:'',
        error: null, // Add an error state
        visibleList:true
      };
    }

    sendDataToParent(id){
        this.props.SearchInputCb([id])
        this.setState({visibleList:false, searchTerm: name});

    }


    handleSearchChange = async (event) => {
      const searchTerm = event.target.value;
      this.setState({ searchTerm, error: null, visibleList:true});


      try {
        const response = await axios.get(`/whms/schedule?search=${searchTerm}`);
        this.setState({ data: response.data });console.log(response);

      } catch (error) {
        this.setState({ error: 'An error occurred while fetching data.' });
      }
    };



    render() {
      const { searchTerm, data, error, visibleList} = this.state;
      return (
        <div className="search-containe">

          <label>Appointment</label>
          <input
          id="search_txt"
            type="number"
            value={searchTerm}
            onChange={this.handleSearchChange}
            className="form-control"
            placeholder='Search for appointment by ID '
          />
          < ul className='results-list'>
          {error ? (
           <li> <p className="error-message">{error}</p></li>
          ) : ( visibleList &&
           data.map(
            supp=><li style={{ zIndex: 3 }} className='dropdown-item' key={supp.id}>
            <button onClick={() => this.sendDataToParent(supp)} className="dropdown-item" type="button">
            {supp.username} <i class="fa-light fa-id-card"></i> {supp.id}
            </button>
          </li>
           )
          )}
          </ul>
        </div>
      );
    }
  }

  export default AppntSearchInput;
