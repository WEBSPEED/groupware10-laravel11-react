import React from 'react'

const SwitchBox = (props) => {
  return (
    <div className="customer-form-switch customer-form-switch-sm" data-toggle="tooltip" >
        <input type="checkbox" className="customer-form-switch-input" name={props.name} id={props.id} value={props.value} checked={props.checked} placeholder={props.placeholder} />
        <div className="customer-form-switch-label">{props.title}</div>
        <div className="customer-form-switch-box">
            <div className="customer-form-switch-circle"></div>
        </div>
    </div>
  )
}

export default SwitchBox
