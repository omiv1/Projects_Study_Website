import { useState } from "react";
import { FiX } from "react-icons/fi";
import { GiMilkCarton, GiSlicedBread, GiShinyApple } from 'react-icons/gi';

const Product = ({ product, onDelete }) => {
    const [isChecked, setIsChecked] = useState(false);

    return (
        <div className='product'>
            <div className='product-info'>
                <div className='input-name'>
                    <input
                        type='checkbox'
                        checked={isChecked}
                        onChange={() => setIsChecked(!isChecked)}
                    />
                    <p className={isChecked ? 'checked' : ''}>{product.name}</p>
                    {product.category === "dairy" && <GiMilkCarton className='category' />}
                    {product.category === "bread" && <GiSlicedBread className='category' />}
                    {product.category === "fruit&vegetables" && <GiShinyApple className='category' />}
                </div>
                <p>{product.quantity}</p>
            </div>
            <div className='product-icons'>
                <FiX onClick={() => onDelete(product.id)} />
            </div>
        </div>
    );
}
export default Product;
