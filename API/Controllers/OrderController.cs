using API.Data;
using API.Models;
using Microsoft.AspNetCore.Mvc;

[ApiController]
[Route("order")]
public class OrderController : ControllerBase
{
    private readonly AppDbContext _dbContext;

    public OrderController(AppDbContext dbContext)
    {
        _dbContext = dbContext;
    }

    [HttpPost("create")]
    public async Task<IActionResult> CreateOrder([FromBody] OrderModel orderModel)
    {
        if (ModelState.IsValid)
        {
            // Validate email format, password strength, etc.

            var order = new OrderModel
            {
                event_id = orderModel.event_id,
                name = orderModel.name,
                email = orderModel.email,
                phone = orderModel.phone,
                qty = orderModel.qty,
                id = orderModel.id
            };

            _dbContext.orders.Add(order);
            await _dbContext.SaveChangesAsync();

            return Ok(new { Success = true, Message = "Order placed successfully" });
        }

        return BadRequest(new { Success = false, Errors = ModelState.Values.SelectMany(v => v.Errors) });
    }

}
