import React from 'react'

const Checkbox = (props) => {
  return (
    <div type="button" className="customer-form-check customer-form-check-sm">
        <input type="checkbox" className="customer-form-check-input" name={props.name} id={props.id} value={props.value} checked={props.checked} placeholder={props.placeholder} onChange={props.onChange} />
        <div className="customer-form-check-box"></div>
        <div className="customer-form-check-label">{props.title}</div>
    </div>
  )
}

export default Checkbox
