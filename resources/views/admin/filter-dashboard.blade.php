<div id="filter-statistical" style="width: 100%">
    <h3 style="padding: 30px 0; text-align: center">Bảng Thống Kê Theo Ngày Tháng</h3>
    <table style="border-collapse: collapse; width: 100%;">
        <tbody style="border: 2px solid #333;">
            <tr style="height: 60px; border: 2px solid #333;">
                <td style="width: 70%; height: 60px; padding:30px">
                    <span style="font-size: 14pt; font-family: 'times new roman', times;">
                        Tổng số khách hàng
                    </span>
                </td>
                <td style="width: 30%; height: 60px; border-left: 2px solid #333;padding:30px ">
                    <span style="font-size: 14pt; font-family: 'times new roman', times;">{{ $users }}</span>
                </td>
            </tr>

            <tr style="height: 60px; border: 2px solid #333;">
                <td style="width: 70%; height: 60px; padding:30px">
                    <span style="font-size: 14pt; font-family: 'times new roman', times;">
                        Tổng số đơn hàng
                    </span>
                </td>
                <td style="width: 30%; height: 60px; border-left: 2px solid #333;padding:30px ">
                    <span style="font-size: 14pt; font-family: 'times new roman', times;">{{ $countOrder }}</span>
                </td>
            </tr>

            <tr style="height: 60px; border: 2px solid #333;">
                <td style="width: 70%; height: 60px; padding:30px">
                    <span style="font-size: 14pt; font-family: 'times new roman', times;">
                        Tổng sản phẩm đã bán
                    </span>
                </td>
                <td style="width: 30%; height: 60px; border-left: 2px solid #333;padding:30px ">
                    <span style="font-size: 14pt; font-family: 'times new roman', times;">
                        {{ $sumProductOrder }}
                    </span>
                </td>
            </tr>

            <tr style="height: 60px; border: 2px solid #333;">
                <td style="width: 70%; height: 60px; padding:30px">
                    <span style="font-size: 14pt; font-family: 'times new roman', times;">
                        Tổng số sản phẩm còn trong kho
                    </span>
                </td>
                <td style="width: 30%; height: 60px; border-left: 2px solid #333;padding:30px ">
                    <span style="font-size: 14pt; font-family: 'times new roman', times;">
                        {{ $AllQuantityProduct }}
                    </span>
                </td>
            </tr>

            <tr style="height: 60px; border: 2px solid #333;">
                <td style="width: 70%; height: 60px; padding:30px">
                    <span style="font-size: 14pt; font-family: 'times new roman', times;">
                        Tổng số sản phẩm đã nhập
                    </span>
                </td>
                <td style="width: 30%; height: 60px; border-left: 2px solid #333;padding:30px ">
                    <span style="font-size: 14pt; font-family: 'times new roman', times;">{{ $AllProductImport }}</span>
                </td>
            </tr>
        </tbody>
    </table>
</div>
